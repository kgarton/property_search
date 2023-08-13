<!-- Search Form -->

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card my-4">
                <div class="card-header">
                    <h2 class="card-title">Property Search</h2>
                </div>
                <div class="card-body">
                    <?= $this->Form->create(null, ['url' => ['controller' => 'Property', 'action' => 'search']]) ?>
                    <div class="form-group">
                        <?= $this->Form->label('location', 'Location') ?>
                        <?= $this->Form->select('location', $locationOptions, ['empty' => true, 'class' => 'form-control', 'default' => $searchCriteria['location'] ?? null, 'placeholder' => 'Select location']) ?>
                    </div>
                    <div class="form-group">
                        <?= $this->Form->label('price_min', 'Price Min') ?>
                        <?= $this->Form->input('price_min', ['type' => 'number', 'step' => 'any', 'class' => 'form-control', 'value' => $searchCriteria['price_min'] ?? null, 'placeholder' => 'Min price']) ?>
                    </div>
                    <div class="form-group">
                        <?= $this->Form->label('price_max', 'Price Max') ?>
                        <?= $this->Form->input('price_max', ['type' => 'number', 'step' => 'any', 'class' => 'form-control', 'value' => $searchCriteria['price_max'] ?? null, 'placeholder' => 'Max price']) ?>
                    </div>
                    <div class="form-group">
                        <?= $this->Form->label('bedrooms', 'Bedrooms') ?>
                        <?= $this->Form->select('bedrooms', $bedroomOptions, ['empty' => true, 'class' => 'form-control', 'default' => $searchCriteria['bedrooms'] ?? null, 'placeholder' => 'Select bedrooms']) ?>
                    </div>
                    <div class="form-group">
                        <?= $this->Form->label('bathrooms', 'Bathrooms') ?>
                        <?= $this->Form->select('bathrooms', $bathroomOptions, ['empty' => true, 'class' => 'form-control', 'default' => $searchCriteria['bathrooms'] ?? null, 'placeholder' => 'Select bathrooms']) ?>
                    </div>
                    <div class="form-group">
                        <button id="clearForm" class="btn btn-secondary" type="button">Clear Form</button>
                    </div>
                    <div class="form-group">
                        <?= $this->Form->button('Search', ['type' => 'submit', 'class' => 'btn btn-primary']) ?>
                    </div>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Search Results -->

<div class="container">
    <?php if ($this->getRequest()->is('post') && !$noMatch): ?>
        <div id="searchResults" class="my-4">
            <h2 class="my-4">Search Results</h2>
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>Location</th>
                        <th>Price</th>
                        <th>Bedrooms</th>
                        <th>Bathrooms</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($properties as $property): ?>
                        <tr>
                            <td><?= h($property->location) ?></td>
                            <td><?= h($property->price) ?></td>
                            <td><?= h($property->bedrooms) ?></td>
                            <td><?= h($property->bathrooms) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<script>

// JS for clearing the form fields and removing the search results
document.addEventListener('DOMContentLoaded', function() {
    var clearButton = document.getElementById('clearForm');
    var form = document.querySelector('form');
    var formInputs = form.querySelectorAll('input, select');
    var searchResults = document.getElementById('searchResults');

    clearButton.addEventListener('click', function() {
        formInputs.forEach(function(input) {
            if (input.type === 'text' || input.type === 'number' || input.tagName === 'SELECT') {
                input.value = '';
            }
        });

        if (searchResults) {
            searchResults.style.display = 'none';
        }
    });

});
</script>
