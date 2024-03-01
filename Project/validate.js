const validation = new JustValidate("#signup", {
    tooltip: {
        position: 'right',
    },
});
validation
    .addField("#username", [
        {
            rule: "required"
        },
        {
            validator: (value) => () => {
                return fetch("validate-username.php?username=" + encodeURIComponent(value))
                .then(function(response) {
                    return response.json();
                })
                .then(function(json) {
                    return json.available;
                })
            },
            errorMessage: "This username is already taken"
        }
    ])
    .addField("#email", [
        {
            rule: "required"
        },
        {
            rule: "email"
        },
        {
            validator: (value) => () => {
                return fetch("validate-email.php?email=" + encodeURIComponent(value))
                .then(function(response) {
                    return response.json();
                })
                .then(function(json) {
                    return json.available;
                })
            },
            errorMessage: "This email is already taken"
        }
    ])
    .addField("#password", [
        {
            rule: "required"
        },
        {
            rule: "password"
        }
    ])
    .addField("#verify-password", [
        {
            validator: (value, fields) => {
                return value == fields["#password"].elem.value;
            },
            errorMessage: "passwords must match."
        }
    ])
    .onSuccess((event) => {
        document.getElementById("signup").submit();
    })