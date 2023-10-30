let deleteQueryBtn = document.querySelectorAll(".delete-button");
let quantity = document.getElementById("quantity");
let itemNames = document.querySelectorAll(".name");

//delete button section
let deleteBtn = document.querySelectorAll(".delete-button");
console.log(localStorage);
/////////////////////////////////////////////////////////
deleteBtn.forEach((button, index) => {
  //remove item from localStorage and html
  button.addEventListener("click", (e) => {
    const currentBtn = e.currentTarget;
    localStorage.removeItem(itemNames[index].innerText.replace(/\s/g, "_"));
    currentBtn.closest(".cart").remove();
  });
});
//=======================================================

deleteQueryBtn.forEach((deleteButton) => {
  deleteButton.addEventListener("click", (e) => {
    let del = e.currentTarget;
    let pick = del.getAttribute("delete-btn-id");
    if (pick) {
      const obj = { deleteId: pick };
      sendDataToPHP(obj);
    }
    location.reload();
  });
});

function sendDataToPHP(data) {
  // URL of the PHP script
  const url = "api.php";

  // Request parameters
  const requestOptions = {
    method: "POST", // You can use 'GET' if you prefer
    headers: {
      "Content-Type": "application/json", // Adjust content type based on your needs
    },
    body: JSON.stringify(data), // Convert data to JSON and send it as the request body
  };

  // Make the Fetch API request
  fetch(url, requestOptions)
    .then((response) => response.json()) // Parse the response as JSON
    .then((data) => {
      quantity.innerText = data;
      // Handle the response from PHP here
    })
    .catch((error) => console.error("Error:", error));
}
