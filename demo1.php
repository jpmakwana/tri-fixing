<ul class="list-options list-extras">
    <li>
        <div class="select-item">
            <input type="checkbox" name="options[]" data-name="Screen Replacement" data-value="100" value="39" id="39" checked="">
            <label for="39">
                <span id="round"></span>Screen Replacement </label>
            <span> <i class="fa fa-inr" aria-hidden="true"> </i>
                <span id="amount39" class="abcd">100</span>
                <sup></sup>
            </span>
        </div>
        <div id="problemtype39" class="sub-radio-buttons">
            <label class="select-item-type">
                <input type="radio" name="type39" value="25" id="39" data-amount="100"> Regular </label>
            <label class="select-item-type">
                <input type="radio" name="type39" value="31" id="39" data-amount="200"> Standard </label>
            <label class="select-item-type">
                <input type="radio" name="type39" value="32" id="39" data-amount="300" checked=""> Premium </label>
        </div>
    </li>
    <li>
        <div class="select-item">
            <input type="checkbox" name="options[]" data-name="Rear Glass Replacement" data-value="150" value="42" id="42" checked="">
            <label for="42">
                <span id="round"></span>Rear Glass Replacement </label>
            <span> <i class="fa fa-inr" aria-hidden="true"> </i>
                <span id="amount42" class="abcd">150</span>
                <sup></sup>
            </span>
        </div>
        <div id="problemtype42" class="sub-radio-buttons">
            <label class="select-item-type">
                <input type="radio" name="type42" value="28" id="42" data-amount="150"> Regular </label>
            <label class="select-item-type">
                <input type="radio" name="type42" value="33" id="42" data-amount="350" checked=""> Standard </label>
        </div>
    </li>
    <li>
        <div class="select-item">
            <input type="checkbox" name="options[]" data-name="OS Restore" data-value="400" value="43" id="43">
            <label for="43">
                <span id="round"></span>OS Restore </label>
            <span> <i class="fa fa-inr" aria-hidden="true"> </i>
                <span id="amount43" class="abcd">400</span>
                <sup></sup>
            </span>
        </div>
        <div id="problemtype43" class="sub-radio-buttons">
            <label class="select-item-type">
                <input type="radio" name="type43" value="34" id="43" data-amount="400"> Regular </label>
        </div>
    </li>
</ul>


<script>
    // Get all the list items
    const listItems = document.querySelectorAll('.list-options li');

    // Loop through each list item
    listItems.forEach(item => {
        // Get the checked radio button within the current list item
        const checkedRadio = item.querySelector('input[type="radio"]:checked');

        // Get the corresponding checkbox within the current list item
        const checkbox = item.querySelector('input[type="checkbox"]');

        // If a checked radio button is found
        if (checkedRadio) {
            // Get the value from the data-amount attribute of the checked radio button
            const amount = checkedRadio.getAttribute('data-amount');

            // Set the value to the corresponding data-value attribute of the checkbox
            checkbox.setAttribute('data-value', amount);

            // Update the text content of the abcd class with the new value
            const abcdElement = item.querySelector('.abcd');
            abcdElement.textContent = amount;
        }
    });
</script>