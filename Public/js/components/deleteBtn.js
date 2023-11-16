// TODO 1. set spacing
// TODO 2. wrong spelling

let quantity = document.getElementById("quantity");
let itemNames = document.querySelectorAll(".name");
let deleteButton = document.querySelectorAll(".delete-button");

deleteButton.forEach((button, index) => {
  //remove item from localStorage and html
  button.addEventListener("click", (e) => {
    const currentBtn = e.currentTarget;
    let pick = currentBtn.getAttribute("delete-btn-id");
    localStorage.removeItem(itemNames[index].innerText.replace(/\s/g, "_"));

    currentBtn.closest(".cart").remove();
    if (pick) {
      const obj = { deleteId: pick };
      sendDataToPHP(obj, index);
    }
  });
});
//=======================================================

function sendDataToPHP(data, index) {
  // URL of the PHP script
  const url = "api.php";

  // Request parameters
  const requestOptions = {
    method: "POST",
    headers: {
      "Content-Type": "application/json", // Adjust content type based on your needs
    },
    body: JSON.stringify(data), // Convert data to JSON and send it as the request body
  };

  // Make the Fetch API request
  fetch(url, requestOptions)
    .then((response) => response.json()) // Parse the response as JSON
    .then((data) => {
      let quantityOfCurrentProduct = Number(num[index].value);

      quantity.innerText = data.quantityOfItems;
      totalSum -= data.item[0].price * quantityOfCurrentProduct;

      document.getElementById("total").innerText = totalSum;
      if (data.quantityOfItems == 0) {
        localStorage.clear();
        location.reload();
      }
      // Handle the response from PHP here
    })
    .catch((error) => console.error("Error:", error));
}
