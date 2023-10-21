const plus = document.querySelectorAll(".plus"),
  minus = document.querySelectorAll(".minus"),
  num = document.querySelectorAll(".num");

let caunt = 1;

plus.forEach((plusButton, currIndex) => {
  plusButton.addEventListener("click", () => {
    caunt++;
    caunt = caunt < 10 ? "0" + caunt : caunt;
    num[currIndex].value = caunt;
  });
});

minus.forEach((minusButton, currIndex) => {
  minusButton.addEventListener("click", () => {
    if (caunt > 1) {
      caunt--;
      caunt = caunt < 10 ? "0" + caunt : caunt;
      num[currIndex].value = caunt;
    }
  });
});
