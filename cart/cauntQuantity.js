const plus = document.querySelectorAll(".plus"),
  minus = document.querySelectorAll(".minus"),
  num = document.querySelectorAll(".num");
let price = document.querySelectorAll(".price");

let sum = 0;
for (let i = 0; i < plus.length; i++) {
  sum += Number(price[i].innerText.match(/\d+/g));
  let count = 1;
  let currentPrice = Number(price[i].innerText.match(/\d+/g));

  plus[i].addEventListener("click", () => {
    count++;
    count = count < 10 ? "0" + count : count;
    num[i].value = count;
    document.getElementById("total").innerText = sum += currentPrice;
  });

  minus[i].addEventListener("click", () => {
    if (count > 1) {
      count--;
      count = count < 10 ? "0" + count : count;
      num[i].value = count;
      document.getElementById("total").innerText = sum -= currentPrice;
    }
  });
}

document.getElementById("total").innerText = sum;
