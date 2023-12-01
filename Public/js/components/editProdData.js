let editBtn = document.querySelectorAll(".edit-btn");
let editName = document.getElementById("editName");
let editPrice = document.getElementById("editPrice");
let editColor = document.getElementById("editColor");
var editModal = new bootstrap.Modal(document.getElementById("editModal"));
let editFormData = document.getElementById("edit-form");
let temp = 0;

//Take data to edit from database
editBtn.forEach((btn) => {
  btn.addEventListener("click", (e) => {
    const currentBtn = e.currentTarget;
    let currentBtnId = currentBtn.getAttribute("edit-btn-id");
    temp = currentBtnId;
    if (currentBtnId) {
      const obj = { editProd: currentBtnId };
      sendDataToServer("editFormApi.php", obj, dataToEdit);
    }
  });
});
// Edit given data
editFormData.addEventListener("click", () => {
  let curId = temp;
  const editDataObj = {
    editedName: editName.value,
    editedPrice: editPrice.value,
    editedColor: editColor.value,
    id: curId,
  };
  if (curId) {
    sendDataToServer("editFormApi.php", editDataObj, (val) => {
      let cellName, cellPrice, imageCell;
      cellName = document.getElementById("prodCell2" + val[0]["id"]);
      cellPrice = document.getElementById("prodCell3" + val[0]["id"]);
      imageCell = document.getElementById("prodCell4" + val[0]["id"]);

      cellName.querySelector("h4").innerText = val[0]["name"];
      cellName.querySelector("h6").innerText = "Color: " + val[0]["color"];
      cellPrice.innerHTML = val[0]["price"] + "$";
      imageCell.innerHTML = `<img src="Public/images/${val[0].id}.png" alt="#" style="height: 150px; width: 150px">`;
    });
  }
  editModal.hide();
});

function sendDataToServer(url, data, callback) {
  const requestOptions = {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(data), // Convert data to JSON and send it as the request body
  };

  // Make the Fetch API request
  fetch(url, requestOptions)
    .then((response) => response.json()) // Parse the response as JSON
    .then((data) => {
      if (callback) {
        callback(data);
      } else {
        console.log(data);
      }
    })
    .catch((error) => console.error("Error:", error));
}

//the function is for that, if your name has double quote or something like this
function toHandleEncodedString(str) {
  let tempElement = document.createElement("div");
  tempElement.innerHTML = str;
  return tempElement.innerText;
}

function dataToEdit(value) {
  let productName = toHandleEncodedString(value[0]["name"]);
  editName.value = productName;
  editPrice.value = value[0]["price"];
  editColor.value = value[0]["color"];
}
