document.addEventListener("DOMContentLoaded", function () {
  let popupContainer = document.getElementById("popupContainer");
  let closeBtn = document.getElementById("closeBtn");

  // Show the popup when the page loads
  popupContainer.style.display = "block";

  // Close the popup when the close button is clicked
  closeBtn.addEventListener("click", function () {
    popupContainer.style.display = "none";
  });

  let cartTable = document.getElementById("cart-table");
  let taxAmountElement = document.getElementById("taxAmount");

  cartTable.addEventListener("click", function (event) {
    let target = event.target;
    if (target && target.classList.contains("removeBtn")) {
      handleRemoveClick(event);
    }
  });

  // Attach event listener to the Add More buttons of the initial rows
  let initialAddMoreButtons = cartTable.querySelectorAll('[id^="addMore"]');
  Array.prototype.forEach.call(initialAddMoreButtons, function (button) {
    attachAddMoreListener(button);
  });

  // Attach delegated event handler to the table to listen for Add More button clicks on dynamically created rows
  cartTable.addEventListener("click", function (event) {
    let target = event.target;
    if (target && target.matches('[id^="addMore"]')) {
      handleAddMoreClick(event);
    }
  });

  // Function to attach event listener to the Add More button
  function attachAddMoreListener(button) {
    button.addEventListener("click", handleAddMoreClick);
  }

  // Function to handle the click event on Add More button
  function handleAddMoreClick(event) {
    event.preventDefault(); // Prevent the default button click behavior

    let button = event.target;
    let row = button.closest(".cart-row");

    // Check if the button has already been clicked
    if (!button.hasAttribute("data-clicked")) {
      button.setAttribute("data-clicked", "true");

      // Create a new row dynamically
      let newRow = createNewRow(row);

      // Append the new row after the current row
      row.parentNode.insertBefore(newRow, row.nextSibling);

      // Remove the event listener from the Add More button in the original row
      button.removeEventListener("click", handleAddMoreClick);

      // Reset the "data-clicked" attribute after a delay
      setTimeout(function () {
        button.removeAttribute("data-clicked");
      }, 1000);

      // Attach event listener to the Add More button of the new row
      let newAddMoreButton = newRow.querySelector('[id^="addMore"]');
      attachAddMoreListener(newAddMoreButton);

      // Calculate the total and update the tax amount
      calculateTotalAndTax();
    }
  }

  // Function to create a new row with unique IDs
  function createNewRow(row) {
    let newRow = document.createElement("tr");
    newRow.className = "cart-row";
    newRow.setAttribute("data-new", "true");

    // Copy the content of the original row
    newRow.innerHTML = row.innerHTML;

    // Generate unique IDs for the elements in the new row
    let categoryName = newRow.querySelector(".name");
    let clonedCheckboxes = newRow.querySelectorAll("input[type='checkbox']");
    let clonedAddMoreButton = newRow.querySelector('[id^="addMore"]');

    let uniqueId = generateRandomId();
    categoryName.id = categoryName.id + uniqueId;
    clonedCheckboxes.forEach(function (checkbox) {
      checkbox.id = checkbox.id + uniqueId;
      checkbox.name = checkbox.name + uniqueId;
    });
    clonedAddMoreButton.id = clonedAddMoreButton.id + uniqueId;

    // Remove the "data-clicked" attribute from the cloned Add More button
    clonedAddMoreButton.removeAttribute("data-clicked");

    return newRow;
  }

  // Function to generate a random ID
  function generateRandomId() {
    return Math.random().toString(36).substr(2, 9);
  }

  // Function to calculate the total and update the tax amount for newly created rows
  function calculateTotalAndTax() {
    let newRows = cartTable.querySelectorAll(".cart-row[data-new='true']");
    let totalPrice = 0;
    let categoryCounts = {};

    // Iterate over each new row and count the number of rows for each category
    Array.prototype.forEach.call(newRows, function (row) {
      let categoryName = row.querySelector(".name").textContent.trim();

      if (!categoryCounts.hasOwnProperty(categoryName)) {
        categoryCounts[categoryName] = 0;
      }

      categoryCounts[categoryName]++;
      console.log(categoryCounts);
    });

    // Update the span elements with the counts
    for (let category in categoryCounts) {
      if (categoryCounts.hasOwnProperty(category)) {
        let spanId = category.toLowerCase() + "Qty";
        let spanElement = document.getElementById(spanId);

        if (spanElement) {
          let count = categoryCounts[category];
          if (!count) {
            count = 0;
          }

          spanElement.textContent = count;
        }
      }
    }

    // Update span elements with 0 count for categories without any new rows
    let allCategoryNames = cartTable.querySelectorAll(".name");
    Array.prototype.forEach.call(allCategoryNames, function (nameElement) {
      let categoryName = nameElement.textContent.trim();
      if (!categoryCounts.hasOwnProperty(categoryName)) {
        let spanId = categoryName.toLowerCase() + "Qty";
        let spanElement = document.getElementById(spanId);
        if (spanElement) {
          spanElement.textContent = "0";
        }
      }
    });

    // Iterate over each new row and add its total to the totalPrice
    Array.prototype.forEach.call(newRows, function (row) {
      let totalElement = row.querySelector("span[id$='Total']");
      let value = parseFloat(totalElement.textContent);
      totalPrice += value;
    });

    // Calculate the tax amount
    let taxAmount = totalPrice * 0.13;

    // Calculate the grand total
    let grandTotal = totalPrice + taxAmount;

    // Update the tax amount element with the calculated value
    taxAmountElement.textContent = taxAmount.toFixed(2);

    // Update the grand total element with the calculated value
    let grandTotalElement = document.getElementById("grandTotal");
    grandTotalElement.textContent = grandTotal.toFixed(2);
  }
  // Attach delegated event handler to the table to listen for Remove button clicks on dynamically created rows

  // Function to handle the click event on Remove button
  function handleRemoveClick(event) {
    event.preventDefault(); // Prevent the default button click behavior

    let button = event.target;
    let row = button.closest(".cart-row");

    // Check if the row is a dynamically created row
    if (
      row &&
      row.classList.contains("cart-row") &&
      !row.classList.contains("original-row") &&
      row.parentNode
    ) {
      // Remove the row from the table
      row.parentNode.removeChild(row);
    }

    // Calculate the total and update the tax amount
    calculateTotalAndTax();
  }

  document
    .getElementById("user-form")
    .addEventListener("submit", function (event) {
      event.preventDefault(); // Prevent the form from submitting normally

      // get the quantitiy of bibim order
      let bibimValue = parseFloat(
        document.getElementById("bibimbopQty").textContent
      );
      let bulValue = parseFloat(
        document.getElementById("bulgogiQty").textContent
      );
      let taxValue = parseFloat(
        document.getElementById("taxAmount").textContent
      );
      let grandTotalValue = document.getElementById("addTotal").textContent;
      console.log(grandTotalValue);

      document.getElementById("bibimContent").value = bibimValue;
      document.getElementById("bulgogiContent").value = bulValue;
      document.getElementById("taxContent").value = taxValue;
      document.getElementById("calculateTotal").value = grandTotalValue;

      // Create an array to hold the dynamically created row data
      let dynamicData = [];

      // Iterate over each dynamically created row
      let dynamicRows = document.querySelectorAll(".cart-row[data-new='true']");
      dynamicRows.forEach(function (row) {
        // Get the values from the options div in the row
        let name = row.querySelector(".name").textContent.trim();
        let ingredients = Array.from(
          row.querySelectorAll(".ingredient-input:checked")
        )
          .map(function (input) {
            return input.value;
          })
          .join(",");
        let price = parseFloat(
          row.querySelector("span[id$='Total']").textContent
        );

        // Create an object representing the row data
        let rowData = {
          name: name,
          ingredients: ingredients,
          price: price,
        };

        // Push the row data object to the dynamicData array
        dynamicData.push(rowData);
      });

      // Set the values as the value of the hidden input field
      document.getElementById("dynamicDataContent").value =
        JSON.stringify(dynamicData);

      console.log("Dynamic Data:", dynamicData);
      document.getElementById("user-form").submit();
    });
});

function openForm() {
  let grandTotal = parseFloat(
    document.getElementById("grandTotal").textContent
  );

  if (grandTotal === 0) {
    alert("Please add a dish(es) to proceed.");
    return;
  }

  document.getElementById("popupForm").style.display = "block";
  let bibimbopQty = document.getElementById("bibimbopQty").innerHTML;
  let bulValue = document.getElementById("bulgogiQty").innerHTML;
  let taxValue = document.getElementById("taxAmount").textContent;
  let grandTotalValue = document.getElementById("grandTotal").textContent;
  document.getElementById("bbpQty").innerHTML = bibimbopQty;
  document.getElementById("bggQty").innerHTML = bulValue;
  document.getElementById("taxAmt").innerHTML = taxValue;
  document.getElementById("addTotal").innerHTML = grandTotalValue;
}
function closeForm() {
  document.getElementById("popupForm").style.display = "none";
}
