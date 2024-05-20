<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <title>E-Waste Details</title>
  <link rel="stylesheet" href="./css/empstyle.css">
  </link>
</head>

<body>
  <h2>E-Waste details</h2>
  <form action="form_action.php" method="post" enctype="multipart/form-data">

  <!-- <label for="userId">Customer ID</label><br>
    <input type="text" id="userId" name="userId" required><br> -->
    
    


    <label for="name">Customer Name</label><br>
    <input type="text" id="name" name="name" required><br>

    <label for="phone">Phone Number</label><br>
    <input type="text" id="phone" name="phone" required><br>

    <label for="location">Address</label><br>
    <input type="text" id="location" name="location" required><br>


    <label for="description"> Select your E-Waste type</label><br>

    <div id="list1" class="dropdown-check-list" tabindex="100">
      <span class="anchor"> E-waste</span>
      <ul class="items">
      <li><input type="checkbox" name="etype[]" value="Mobile">Mobile </li>
        <li><input type="checkbox" name="etype[]" value="Charger">Charger</li>
        <li><input type="checkbox" name="etype[]" value="Headphones">Headphones </li>
        <li><input type="checkbox" name="etype[]" value="Smartwatch">Smartwatch </li>
        <li><input type="checkbox" name="etype[]" value="Router">Router </li>
        
        <li><input type="checkbox" name="etype[]" value="Camera">Camera </li>
        
        <li><input type="checkbox" name="etype[]" value="Solar_Panels">Solar Panels </li>
        <li><input type="checkbox" name="etype[]" value="Microwave">Microwave </li>
        <li><input type="checkbox" name="etype[]" value="Refrigerator">Refrigerator</li>
        <li><input type="checkbox" name="etype[]" value="Motherboard">Motherboard</li>
        <li><input type="checkbox" name="etype[]" value="Tablet">Tablet</li>
      </ul>
    </div>

    <label for="condition">Condition of E-Waste</label>
    <div class="form-check">
      <input class="form-check-input" type="radio" name="condition1" id="working" value="Working">
      <label class="form-check-label" for="working">Working</label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="radio" name="condition1" id="non-working" value="Non Working" checked>
      <label class="form-check-label" for="non-working">Non Working</label>
    </div><br>

    <label for="quantity">Quantity of E-Waste</label>
    <div class="form-check">
      <input class="form-check-input" type="radio" name="quantity" id="less" value="Less than 5kg">
      <label class="check-label" for="less">Less than 5kg</label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="radio" name="quantity" id="greater" value="Greater than 5kg">
      <label class="check-label" for="greater">Greater than 5kg</label>
    </div>

    <label for="pickup">Pickup or Drop-off Preference</label><br>
    <select id="pickup" name="service">
      <option value="pickup">Pickup</option>
      <option value="drop-off">Drop-off</option>
    </select><br>

    <label for="pickup_date">Preferred Pickup Date</label>
    <label class="date" for="strat">From</label>
    <input type="date" id="start_date" name="start_date">
    <br>
    <label class="date" for="end">To</label>
    <input type="date" id="end_date" name="end_date"><br><br>

    <input type="checkbox" id="acknowledgment" name="acknowledgment" required>
    <label for="acknowledgment">I acknowledge responsibility for the proper disposal of e-waste according to the organization's policies.</label><br>

    <button class="btn btn-success" name="form_submit">Submit </button>

  </form>

</body>
<script>
  var checkList = document.getElementById('list1');
  checkList.getElementsByClassName('anchor')[0].onclick = function(evt) {
    if (checkList.classList.contains('visible'))
      checkList.classList.remove('visible');
    else
      checkList.classList.add('visible');
  }

  const quantityInput = document.getElementsByName('quantity');
  const pickupSelect = document.getElementById('pickup');

  quantityInput.forEach(radio => {
    radio.addEventListener('change', (event) => {
      if (event.target.id === 'less') {
        pickupSelect.value = 'drop-off'; // Set drop-off for less than 5kg
      } else {
        pickupSelect.value = 'pickup'; // Set pickup for greater than 5kg
      }
    });
  });
</script>


</html>