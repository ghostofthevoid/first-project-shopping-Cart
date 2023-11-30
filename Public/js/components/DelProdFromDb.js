let removefromDbBtn = document.querySelectorAll(".remove-btn");

// Delete a prosuct from database
removefromDbBtn.forEach((button) => {
  button.addEventListener("click", (e) => {
    if (confirm("Are you sure that you want to REMOVE the product?")) {
      const currentBtn = e.currentTarget;
      currentBtn.closest(".item-body").remove();
      let pick = currentBtn.getAttribute("delete-btn-id");

      if (pick) {
        const obj = { removeProd: pick };
        sendDataToServer("api.php", obj);
      }
    }
  });
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
