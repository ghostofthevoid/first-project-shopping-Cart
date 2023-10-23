const plus = document.querySelectorAll(".plus"),
  minus = document.querySelectorAll(".minus"),
  num = document.querySelectorAll(".num");

for (let i = 0; i < plus.length; i++) {
  let caunt = 1;
  plus[i].addEventListener("click", () => {
    caunt++;
    caunt = caunt < 10 ? "0" + caunt : caunt;
    num[i].value = caunt;
  });

  minus[i].addEventListener("click", () => {
    if (caunt > 1) {
      caunt--;
      caunt = caunt < 10 ? "0" + caunt : caunt;
      num[i].value = caunt;
    }
  });
}
