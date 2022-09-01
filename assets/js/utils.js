/**
 *Only number in the input
 *
 * @param {*} e
 * @returns
 */
function onlyNumber(e) {
	var key = window.Event ? e.which : e.keyCode;
	return key >= 48 && key <= 57;
}

/* ------ Example ajax jquery */
$.ajax({
	type: "POST",
	url: "validate/ajaxValidateNombres",
	data: data,
	success: function (respuesta) {
		console.log(respuesta);
	},
	error: function () {
		console.log("No se ha podido obtener la información");
	},
});

/* ------  Example ajax jquery done.fail.always */
$.ajax({
	type: "POST",
	url: "abonos/ajax_generar_abono",
	data: data,
	dataType: "json",
})
	.done(function (result) {
		console.log(result);
	})
	.fail(function (xhr, status, error) {
		console.log(xhr + "\n" + status + "\n" + "\n" + error);
	})
	.always(function (xhr, status) {
		console.log("Estado Peticion: " + status);
	});

/* ------ Example fetch */
const form = document.querySelector("#form");
form.addEventListener("submit", function (e) {
	e.preventDefault();
	const formData = new FormData(form);
	fetch("script.php", {
		method: "post",
		body: formData,
	})
		.then(function (response) {
			if (response.ok) {
				return response.json();
			} else {
				throw "Error en la llamada Ajax";
			}
		})
		.then(function (data) {
			console.log(data);
		})
		.catch(function (error) {
			console.log("Catch error: " + error);
		});
});

/**
 *
 * @param {string} loader <none || block>
 */
const gifLoader = function (loader = "none") {
	document.querySelector("#gif-loader").style.display = loader;
};
