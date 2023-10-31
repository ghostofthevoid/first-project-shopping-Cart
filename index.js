let myElement = document.getElementsByClassName("add-product-to-card");
let quantity = document.getElementById("quantity");

function myEventHandler() {
  let specificIdOfItem = Number(this.getAttribute("data-shit-id"));
  let numObj = { num: specificIdOfItem };
  sendDataToPHP(numObj);
}

Object.keys(myElement).forEach(function (key) {
  myElement[key].addEventListener("click", myEventHandler);
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
      console.log(data);
      // Handle the response from PHP here
    })
    .catch((error) => console.error("Error:", error));
}
