let histTab = document.querySelector(".hist-tab");
let recentTab = document.querySelector(".recent-tab");
let incTab = document.querySelector(".inc-tab");

let histList = document.querySelector(".hist-list .list");
let incList = document.querySelector(".inc-list .list");
let recentList = document.querySelector(".recent-list .list");

let history = document.querySelector(".hist-list");
let income = document.querySelector(".inc-list");
let recent = document.querySelector(".recent-list");

let modal = document.querySelector("#modal");

histTab.addEventListener("click", function showOthers() {
  recentTab.classList.remove("active");
  incTab.classList.remove("active");
  recentTab.classList.add("hide");
  incTab.classList.add("hide");
  histTab.classList.remove("hide");
  histTab.classList.add("active");

  history.classList.remove("inactive");
  recent.classList.add("inactive");
  income.classList.add("inactive");
});
incTab.addEventListener("click", function showOthers() {
  recentTab.classList.remove("active");
  histTab.classList.remove("active");
  recentTab.classList.add("hide");
  histTab.classList.add("hide");
  incTab.classList.remove("hide");
  incTab.classList.add("active");

  income.classList.remove("inactive");
  recent.classList.add("inactive");
  history.classList.add("inactive");
});
recentTab.addEventListener("click", function showOthers() {
  incTab.classList.remove("active");
  histTab.classList.remove("active");
  incTab.classList.add("hide");
  histTab.classList.add("hide");
  recentTab.classList.remove("hide");
  recentTab.classList.add("active");

  recent.classList.remove("inactive");
  history.classList.add("inactive");
  income.classList.add("inactive");
});

/*addInc.addEventListener("click", function(){
  if (!incomeDesc.value || !incomeAmt.value) return;
  
  let incomeEntry = {
    type: "income",
    desc: incomeDesc.value,
    amount: parseFloat(incomeAmt.value)
  };
  Budget.push(incomeEntry);
  console.log(Budget);
});
addExp.addEventListener("click", function(){
  if (!expenseDesc.value || !expenseAmt.value) {
    document.querySelector("#error"). innerHTML = "nooooooooooo, put something"
return}
  
  let expenseEntry = {
    type: "expense",
    desc: expenseDesc.value,
    amount: parseFloat(expenseAmt.value)
  }
  Budget.push(expenseEntry)
  console.log(Budget)
})
*/
function openModal(event) {
  modal.style.display = "flex";
}

function closeModal(event) {
  modal.style.display = "none";
}

document.addEventListener("dblclick", function toggleModalClose(e) {
  if (modal.style.display == "flex" && e.target.className == "form") {
    console.log(e.target.className);
    closeModal();
  }
});
