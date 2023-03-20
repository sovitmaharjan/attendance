<script>
    var validation_errors = @json($errors->getMessages());
    for (const [key, value] of Object.entries(validation_errors)) {
        $(`#${key}`).css({
            "border": "1px solid #f1416c"
        });
        $(`
            <div class="fv-plugins-message-container invalid-feedback">
                <div data-field="name" data-validator="notEmpty">
                    ${value[0]}
                </div>
            </div>
        `).insertAfter($(`#${key}`).parent());
    }
</script>
