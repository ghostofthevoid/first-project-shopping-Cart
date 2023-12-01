const form = document.getElementById("form-add");
let alertDiv = document.querySelector(".alert-mess");
var addModal = new bootstrap.Modal(document.getElementById("addModal"));
let table = document.getElementById("prodTable");

//Add a new product
form.addEventListener("submit", (e) => {
  e.preventDefault();
  const formData = new FormData(form);
  fetch("api.php", {
    method: "POST",
    body: formData,
  })
    .then((response) => response.json())
    .then((data) => {
      console.log(data);

      addNewTableRow(data);
    })
    .catch((error) => {
      console.error("Error:", error);
    });
  alertMessage(alertDiv, "Product added successfully");
  addModal.hide();
});

// Make request to the server
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

function alertMessage(htmlElement, message) {
  let newDiv = `<div class="alert alert-success alert-dismissible">
  <button type="button" id="alert-btn-close" class="btn-close" data-bs-dismiss="alert"></button>
  <strong>Success!</strong> ${message}</div>`;
  htmlElement.innerHTML += newDiv;
}

function addNewTableRow(val) {
  const newRow = document.createElement("tr");
  newRow.innerHTML = `
  <th scope="row" class="pl-5">${val[0].id}</th>
  <td>${val[0].name}</td>
  <td>${val[0].price}$</td>
  <td><img src="Public/images/${val[0].id}.png" alt="#" style="height: 150px; width: 150px"></td>
  <td>
      <button type="button" class="btn btn-warning edit-btn" edit-btn-id="<?= $item->id ?>" data-bs-toggle="modal" data-bs-target="#modalEdit">Edit</button>
      <button type="button" class="btn btn-danger remove-btn" delete-btn-id="<?= $item->id ?>"> Remove</button>
  
  </td>
  `;
  console.log(table.getElementsByTagName("tbody")[0]);
  table.querySelector("tbody").appendChild(newRow);
  // table.getElementsByTagName("tbody")[0].appendChild(newRow);
}
