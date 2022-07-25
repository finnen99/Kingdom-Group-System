 $(function () {

    const idCity = '3522210';
    const apikey = '10427e70eb75599170aa8315029b30f5';
    const lang = 'es';
    const units = 'metric'
    
    $.ajax({
        type: "GET",
        url: `https://api.openweathermap.org/data/2.5/weather?id=${idCity}&appid=${apikey}&lang=${lang}&units=${units}`,
        dataType: "json",
        success: function ({main: { temp, feels_like }, weather:[{icon}], name}) {
            $('#wheater').append(`<img src="http://openweathermap.org/img/wn/${icon}.png">`);
            $('#wheater').append(`<p class="mb-0"> ${ name } </p>`);
            $('#wheater').append(`<p class="mb-0"> Temperatura: ${temp}°C </p>`);
            $('#wheater').append(`<p class="mb-0"> Sensación Térmica: ${feels_like}°C </p>`);
        }
    });

 });