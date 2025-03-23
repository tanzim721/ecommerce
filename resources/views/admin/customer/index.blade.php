<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Customer List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .form-section {
            display: none;
        }
        .form-section.active {
            display: block;
        }
        .progress-bar {
            transition: width 0.5s ease-in-out;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4>Add New Customer</h4>
                        <div class="progress mt-2">
                            <div class="progress-bar" role="progressbar" style="width:25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">Step 1 of 4</div> 
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="alert-container"></div>
                        <form id="customer-form">
                            <!-- Step 1: Name -->
                            <div class="form-section active" id="step-1">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" required placeholder="Enter your name">
                                    <div class="invalid-feedback" id="name-error"></div>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="button" class="btn btn-primary next-step">Next</button>
                                </div>
                            </div>
                            <!-- Step 2: Designation -->
                            <div class="form-section" id="step-2">
                                <div class="mb-3>
                                    <label for="designation" class="form-label">Designation</label>
                                    <input type="text" class="form-control" id="designation" name="designation" required placeholder="Enter your designation">
                                    <div class="invalid-feedback" id="designation-error"></div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <button type="button" class="btn btn-primary prev-step">Previous</button>
                                    <button type="button" class="btn btn-primary next-step">Next</button>
                                </div>
                            </div>
                            <!-- Step 3: Address -->
                            <div class="form-section" id="step-3">
                                <div class="mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <textarea class="form-control" id="address" name="address" required placeholder="Enter your address"></textarea>
                                    <div class="invalid-feedback" id="address-error"></div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <button type="button" class="btn btn-primary prev-step">Previous</button>
                                    <button type="button" class="btn btn-primary next-step">Next</button>
                                </div>
                            </div>
                            <!-- Step 4: Number -->
                            <div class="form-section" id="step-4">
                                <div class="mb-3">
                                    <label for="number" class="form-label">Number</label>
                                    <input type="text" class="form-control" id="number" name="number" required placeholder="Enter your number">
                                    <div class="invalid-feedback" id="number-error"></div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <button type="button" class="btn btn-primary prev-step">Previous</button>
                                    <button type="submit" class="btn btn-primary" id="submit-btn">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            let currentStep = 1;
            const totalStep = 4;

            // Next button click
            $('.next-step').click(function(){
                let isValid = validateStep(currentStep);
                if (isValid) {
                    $('#step-'+currentStep).removeClass('active');
                    currentStep++;
                    $('#step-'+currentStep).addClass('active');
                    updateProgressBar();                    
                }
            });

            // Previous button click
            $('.prev-step').click(function(){
                $('#step-'+currentStep).removeClass('active');
                currentStep--;
                $('#step-'+currentStep).addClass('active');
                updateProgressBar();
            });

            // Prevoius button click
            function updateProgressBar() {
                let progressPercentage = (currentStep / totalStep) * 100;
                $('.progress-bar').css('width', progressPercentage+'%');
                $('.progress-bar').attr('aria-valuenow', progressPercentage);
                $('.progress-bar').text('Step '+currentStep+' of '+totalStep);
            }

            // Form validation
            function validateStep(step) {
                let isValid = true;
                switch(step) {
                    case 1:
                        if (!$('#name').val().trim()) {
                            $('#name').addClass('is-invalid');
                            $('#name-error').text('Name is required');
                            isValid = false;
                        } else {
                            $('#name').removeClass('is-invalid');
                        }
                        break;
                    case 2:
                        if (!$('#designation').val().trim()) {
                            $('#designation').addClass('is-invalid');
                            $('#designation-error').text('Designation is required');
                            isValid = false;
                        } else {
                            $('#designation').removeClass('is-invalid');
                        }
                        break;
                    case 3:
                        if (!$('#address').val().trim()) {
                            $('#address').addClass('is-invalid');
                            $('#address-error').text('Address is required');
                            isValid = false;
                        } else {
                            $('#address').removeClass('is-invalid');
                        }
                        break;
                    case 4:
                        if (!$('#number').val().trim()) {
                            $('#number').addClass('is-invalid');
                            $('#number-error').text('Phone Number is required');
                            isValid = false;
                        } else {
                            $('#number').removeClass('is-invalid');
                        }
                        break;
                }
                
                return isValid;
            }
            // Form submission
            $('#customer-form').submit(function(e) {
                e.preventDefault();
                
                // Validate final step
                if (!validateStep(currentStep)) {
                    return false;
                }
                
                // Disable submit button to prevent double submission
                $('#submit-btn').prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Saving...');
                
                // Collect form data
                let formData = {
                    name: $('#name').val(),
                    designation: $('#designation').val(),
                    address: $('#address').val(),
                    number: $('#number').val()
                };
                
                // Submit data via AJAX
                $.ajax({
                    type: 'POST',
                    url: '/customers',
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        // Display success message
                        $('#alert-container').html(
                            '<div class="alert alert-success">' + 
                                response.message + 
                            '</div>'
                        );
                        
                        // Reset form
                        $('#customer-form')[0].reset();
                        
                        // Go back to first step
                        $('#step-' + currentStep).removeClass('active');
                        currentStep = 1;
                        $('#step-' + currentStep).addClass('active');
                        updateProgressBar();
                        
                        // Re-enable submit button
                        $('#submit-btn').prop('disabled', false).text('Save Customer');
                    },
                    error: function(xhr) {
                        // Re-enable submit button
                        $('#submit-btn').prop('disabled', false).text('Save Customer');
                        
                        // Handle validation errors
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            
                            // Clear previous error messages
                            $('.is-invalid').removeClass('is-invalid');
                            
                            // Display new error messages
                            if (errors.name) {
                                $('#name').addClass('is-invalid');
                                $('#name-error').text(errors.name[0]);
                            }
                            if (errors.designation) {
                                $('#designation').addClass('is-invalid');
                                $('#designation-error').text(errors.designation[0]);
                            }
                            if (errors.address) {
                                $('#address').addClass('is-invalid');
                                $('#address-error').text(errors.address[0]);
                            }
                            if (errors.number) {
                                $('#number').addClass('is-invalid');
                                $('#number-error').text(errors.number[0]);
                            }
                        } else {
                            // Display general error message
                            $('#alert-container').html(
                                '<div class="alert alert-danger">' + 
                                    'An error occurred while saving the customer. Please try again.' + 
                                '</div>'
                            );
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>