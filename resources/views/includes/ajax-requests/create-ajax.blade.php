<script>
    $(document).ready(function() {
        let activeSubmitBtn = null;
        let formSubmitting = false;

        $(document).on('click', '#submit-form button[type="submit"]', function() {
            activeSubmitBtn = this;
        });

        $(document).on('submit', '#submit-form', function(e) {
            e.preventDefault();

            if (formSubmitting) {
                return;
            }

            let form = $(this);
            let submitBtn = activeSubmitBtn
                ? $(activeSubmitBtn)
                : form.find('button[type="submit"]').first();
            let btnOriginalHtml = submitBtn.html();
            let formData = new FormData(form[0]);

            formSubmitting = true;

            $.ajax({
                url: form.attr('action'),
                type: form.attr('method'),
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                },
                beforeSend: function() {
                    form.find('button[type="submit"]').prop('disabled', true);
                    submitBtn.html('Saving...');
                },
                success: function(response) {
                    console.log(response);
                    form.find('button[type="submit"]').prop('disabled', false);
                    submitBtn.html(btnOriginalHtml);
                    activeSubmitBtn = null;

                    if (response.success) {
                        Swal.fire({
                            icon: "success",
                            title: response.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                        form[0].reset();
                        if ($('#editProfileModal').length) {
                            $('#editProfileModal').modal('hide');
                        }
                        if (response.data && response.data.user) {
                            updateProfileUI(response.data.user);
                        }
                        setTimeout(function() {
                            if (response.redirect) {
                                window.location.href = response.redirect;
                            }
                        }, 1500);
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: response.message || 'Something went wrong.',
                            showConfirmButton: true
                        });
                    }
                },
                error: function(xhr) {
                    form.find('button[type="submit"]').prop('disabled', false);
                    submitBtn.html(btnOriginalHtml);
                    activeSubmitBtn = null;

                    const data = xhr.responseJSON || {};
                    const errors = data.errors;

                    if (errors && Object.keys(errors).length) {
                        handleValidationErrors(errors);

                        const errorList = Object.keys(errors).map(function(key) {
                            const label = key.replace(/\.\d+\./g, ' ').replace(/\./g, ' ').replace(/_/g, ' ');
                            return '<li><strong>' + label + ':</strong> ' + errors[key][0] + '</li>';
                        }).join('');

                        Swal.fire({
                            icon: "error",
                            title: "Please fix the following",
                            html: '<ul style="text-align:left;margin:0;padding-left:1.25rem;">' + errorList + '</ul>',
                            showConfirmButton: true
                        });

                        const firstInvalid = form.find('.is-invalid').first();
                        if (firstInvalid.length) {
                            $('html, body').animate({
                                scrollTop: firstInvalid.offset().top - 120
                            }, 300);
                        }
                        return;
                    }

                    if (data.message) {
                        Swal.fire({
                            icon: "error",
                            title: data.message,
                            showConfirmButton: true
                        });
                        return;
                    }

                    Swal.fire({
                        icon: "error",
                        title: "An error occurred. Please try again.",
                        showConfirmButton: true
                    });
                },
                complete: function() {
                    formSubmitting = false;
                }
            });
        });

        $(document).on('input change keydown', 'input, select, textarea', function() {
            $(this).next('span.error-message').remove();
            $(this).removeClass('is-invalid');
            $(this).closest('.faq-row').removeClass('border-danger');
        });

        function handleValidationErrors(errors) {
            $('.error-message').remove();
            $('.form-control, .form-select').removeClass('is-invalid');
            $('.faq-row').removeClass('border-danger');
            $('#quill-editor').removeClass('border border-danger');

            $.each(errors, function(key, messages) {
                let nameAttr = key.replace(/\.(\d+)/g, "[$1]").replace(/\.(\w+)/g, "[$1]");
                let message = messages[0];

                let inputField = $(
                    `input[name="${nameAttr}"], select[name="${nameAttr}"], textarea[name="${nameAttr}"]`
                );

                if (inputField.length > 0) {
                    inputField.addClass('is-invalid');

                    if (nameAttr === "rating") {
                        if ($(".rating-main-div .error-message").length === 0) {
                            $(".rating-main-div").after(
                                `<span class="error-message text-danger d-block mt-1">${message}</span>`
                            );
                        }
                    } else if (nameAttr.startsWith('faqs[')) {
                        inputField.last().after(
                            `<span class="error-message text-danger d-block mt-1">${message}</span>`
                        );
                        inputField.closest('.faq-row').addClass('border-danger');
                    } else {
                        inputField.last().after(
                            `<span class="error-message text-danger d-block mt-1">${message}</span>`
                        );
                    }
                    return;
                }

                if (key === 'content') {
                    $('#quill-editor').addClass('border border-danger');
                    $('#quill-editor').after(
                        `<span class="error-message text-danger d-block mt-1">${message}</span>`
                    );
                    return;
                }

                console.warn('No input found for validation key:', key);
            });
        }
    });
</script>
