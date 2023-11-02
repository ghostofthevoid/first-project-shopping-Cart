const plus = document.querySelectorAll(".plus"),
  minus = document.querySelectorAll(".minus"),
  num = document.querySelectorAll(".num"),
  itemPrice = document.querySelectorAll(".price"),
  itemName = document.querySelectorAll(".name");
let totalAmount = document.getElementById("total");
let totalSum = 0;

itemPrice.forEach((currentItemPrice, index) => {
  let currentStorageValue = localStorage.getItem(
    itemName[index].innerText.replace(/\s/g, "_")
  );
  let itemPrice = Number(currentItemPrice.innerText.match(/\d+/g));

  if (currentStorageValue) {
    totalSum += itemPrice * Number(currentStorageValue);
  } else {
    totalSum += itemPrice;
  }
});

totalAmount.innerText = totalSum;

num.forEach((num, index) => {
  num.value =
    localStorage.getItem(itemName[index].innerText.replace(/\s/g, "_")) || "01"; //Get quantity of item from localStorage by item name
});

for (let i = 0; i < plus.length; i++) {
  let count = parseInt(
    localStorage.getItem(itemName[i].innerText.replace(/\s/g, "_")) || 1
  ); // get data of item counter from localStorage
  let currentitemPrice = Number(itemPrice[i].innerText.match(/\d+/g)); //get itemPrice of current item

  plus[i].addEventListener("click", () => {
    if (!isNaN(count)) {
      count++;
      totalAmount.innerText = totalSum += currentitemPrice;
      updateValue(count, i);
    }
  });

  minus[i].addEventListener("click", () => {
    if (!isNaN(count)) {
      if (count > 1) {
        count--;
        totalAmount.innerText = totalSum -= currentitemPrice;
        updateValue(count, i);
      }
    }
  });
}

function updateValue(newValue, index) {
  let key = itemName[index].innerText.replace(/\s/g, "_");
  num[index].value = newValue < 10 ? `0${newValue}` : newValue.toString();
  localStorage.setItem(key, num[index].value);
}
