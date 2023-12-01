function handleSelectChange(select) {
  var customInput = document.getElementById("customInput");
  if (select.value === "custom") {
    customInput.style.display = "block";
  } else {
    customInput.style.display = "none";
  }
}

function handleCustomOption() {
  var customInput = document.getElementById("customInput");
  var select = document.getElementById("mySelect");
  var customOption = customInput.value;

  var option = document.createElement("option");
  option.text = customOption;
  option.value = customOption;
  select.add(option);

  option.selected = true;

  customInput.style.display = "none";
}