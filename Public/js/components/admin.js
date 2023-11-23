let removefromDbBtn = document.querySelectorAll(".remove-btn");
let editBtn = document.querySelectorAll(".edit-btn");
let editName = document.getElementById("editName");
let editPrice = document.getElementById("editPrice");
let editColor = document.getElementById("editColor");
const submitBtn = document.querySelector(".butt");

removefromDbBtn.forEach((button) => {
  button.addEventListener("click", (e) => {
    if (confirm("Are you sure that you want to REMOVE the product?")) {
      const currentBtn = e.currentTarget;
      currentBtn.closest(".item-body").remove();
      let pick = currentBtn.getAttribute("delete-btn-id");

      if (pick) {
        const obj = { removeProd: pick };
        sendDataToPHP(obj);
      }
    }
  });
});

editBtn.forEach((btn) => {
  btn.addEventListener("click", (e) => {
    const currentBtn = e.currentTarget;
    let pick = currentBtn.getAttribute("edit-btn-id");
    if (pick) {
      const obj = { editProd: pick };
      sendDataToPHP(obj, dataToEdit);
    }
  });
});

function sendDataToPHP(data, callback) {
  const url = "api.php";

  // Request parameters
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
        console.log(data);
        callback(data);
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
