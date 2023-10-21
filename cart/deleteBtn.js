let deleteQueryBtn = document.querySelectorAll(".delete-button");

//delete button section
let deleteBtn = document.querySelectorAll(".delete-button");

function handelClick(e) {
  const currentBtn = e.currentTarget;
  currentBtn.closest(".cart").remove();
}
deleteBtn.forEach((button) => {
  button.addEventListener("click", handelClick);
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
      console.log(data);
      // Handle the response from PHP here
    })
    .catch((error) => console.error("Error:", error));
}
