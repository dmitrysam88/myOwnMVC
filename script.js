$('#buttonPreview').click( preview );
(function() {
    $("#picture").change(function(e) {
        console.log('1');
        var file, reader;
        file = e.target.files[0];
        reader = new FileReader();
        reader.onload = function(e) {
            var image;
            image = new Image();
            image.src = e.target.result;
            return image.onload = function() {
                console.log('2');
                $("#preview_image").show("fast");
                return $("#preview_image").attr('src', this.src);
            };
        };
        console.log('3');
        return reader.readAsDataURL(file);
    });

}).call(this);
function preview(){
    $("#show-name").empty();
    $("#show-email").empty();
    $("#show-text").empty();
    var date_str;
    var date = new Date();
    date_str = date.getFullYear() + '-' + date.getMonth() + '-' + date.getDate();
    if ($("#inputText").val() != '' &&  $("#inputEmail").val() != '' && $("#inputName").val() != ''){
        $("#previousLi").show("fast");
        $("#show-name").append('Автор: ' + $("#inputName").val() );
        $("#show-email").append('E-mail: ' + $("#inputEmail").val() );
        $("#show-text").append('Текст: ' + $("#inputText").val() );
    }
};