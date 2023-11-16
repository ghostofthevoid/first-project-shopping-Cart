let removefromDbBtn = document.querySelectorAll(".remove-btn");

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

function sendDataToPHP(data) {
  // URL of the PHP script
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
      console.log(data);
      // Handle the response from PHP here
    })
    .catch((error) => console.error("Error:", error));
}
