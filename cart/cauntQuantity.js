const plus = document.querySelectorAll(".plus"),
  minus = document.querySelectorAll(".minus"),
  num = document.querySelectorAll(".num"),
  itemPrice = document.querySelectorAll(".price"),
  itemName = document.querySelectorAll(".name");
let totalAmount = document.getElementById("total");
let totalSum = 0;

console.log(localStorage.getItem("total_sum"));

if (localStorage.getItem("total_sum")) {
  totalAmount.innerText = localStorage.getItem("total_sum");
} else {
  itemPrice.forEach((currentValue) => {
    totalSum += Number(currentValue.innerText.match(/\d+/g));
  });
}

num.forEach((num, index) => {
  num.value =
    localStorage.getItem(itemName[index].innerText.replace(/\s/g, "_")) || "01"; //Get quantity of item from localStorage by item name
});

for (let i = 0; i < plus.length; i++) {
  //totalSum += Number(itemPrice[i].innerText.match(/\d+/g));

  let count = parseInt(
    localStorage.getItem(itemName[i].innerText.replace(/\s/g, "_")) || 1
  ); // get data of item counter from localStorage
  let currentitemPrice = Number(itemPrice[i].innerText.match(/\d+/g)); //get itemPrice of current item

  plus[i].addEventListener("click", () => {
    if (!isNaN(count)) {
      count++;
      updateValue(count, i);
    }
    totalSum += currentitemPrice;
  });

  minus[i].addEventListener("click", () => {
    if (!isNaN(count)) {
      if (count > 1) {
        count--;
        updateValue(count, i);
        totalSum -= currentitemPrice;
      }
    }
  });
}

function updateValue(newValue, index) {
  let key = itemName[index].innerText.replace(/\s/g, "_");
  num[index].value = newValue < 10 ? `0${newValue}` : newValue.toString();
  localStorage.setItem(key, num[index].value);
  localStorage.setItem("total_sum", totalSum);
  totalAmount.innerText = totalSum;
}
