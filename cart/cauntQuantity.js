const plus = document.querySelectorAll(".plus"),
  minus = document.querySelectorAll(".minus"),
  num = document.querySelectorAll(".num"),
  price = document.querySelectorAll(".price"),
  itemName = document.querySelectorAll(".name");

console.log(localStorage);
//Get quantity of item from localStorage by item name
num.forEach((num, index) => {
  num.value =
    localStorage.getItem(itemName[index].innerText.replace(/\s/g, "_")) || "01";
});

let sum = 0;
for (let i = 0; i < plus.length; i++) {
  sum += Number(price[i].innerText.match(/\d+/g));
  let count = parseInt(
    localStorage.getItem(itemName[i].innerText.replace(/\s/g, "_")) || 0
  );
  //get price for current item
  let currentPrice = Number(price[i].innerText.match(/\d+/g));

  plus[i].addEventListener("click", () => {
    if (!isNaN(count)) {
      count++;
      updateValue(count, i);
    }
    document.getElementById("total").innerText = sum += currentPrice;
  });

  minus[i].addEventListener("click", () => {
    if (!isNaN(count)) {
      if (count > 1) {
        count--;
        updateValue(count, i);
        document.getElementById("total").innerText = sum -= currentPrice;
      }
    }
  });
}
document.getElementById("total").innerText = sum;

function updateValue(newValue, index) {
  let key = itemName[index].innerText.replace(/\s/g, "_");
  num[index].value = newValue < 10 ? `0${newValue}` : newValue.toString();
  localStorage.setItem(key, num[index].value);
}
