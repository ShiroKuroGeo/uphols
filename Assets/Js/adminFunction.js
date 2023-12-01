function searchTable() {
    // Get input element and table
    var input = document.getElementById("seachUserFromTable");
    var table = document.getElementById("tableForUsers");
    
    // Convert input value to lowercase for case-insensitive search
    var filter = input.value.toLowerCase();
    
    // Get table rows
    var rows = table.getElementsByTagName("tr");
    
    // Loop through rows and hide those that don't match the search query
    for (var i = 0; i < rows.length; i++) {
      var row = rows[i];
      var rowData = row.getElementsByTagName("td");
      var found = false;
      
      // Loop through row data and check if it matches the search query
      for (var j = 0; j < rowData.length; j++) {
        var cell = rowData[j];
        
        if (cell.innerText.toLowerCase().indexOf(filter) > -1) {
          found = true;
          break;
        }
      }
      
      // Show/hide row based on search result
      if (found) {
        row.style.display = "";
      } else {
        row.style.display = "none";
      }
    }
  }
  
  // Attach event listener to the search input
  var searchInput = document.getElementById("searchInput");
  searchInput.addEventListener("input", searchTable);
  