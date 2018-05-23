/**
 * Created by ww on 22.05.2018.
 */
$( document ).ready(function() {
    $('.delete_btn').on("click", function(e) {
        var id_attr = $(this).attr("id")

        e.preventDefault();
        $.ajax({
            method: "GET",
            url: "/tasks/delete/" + id_attr,
            success: function () {
                console.log("entered");
                $("#task_" + id_attr).slideUp(function() {
                    $("#task_" + id_attr).remove();
                });

            }
        })
    });

    $('.move_btn').on("click", function(e) {
        var id_attr = $(this).attr("id").split("_")[1];

        e.preventDefault();
        $.ajax({
            method: "GET",
            url: "/tasks/change/" + id_attr,
            success: function () {
                $("#task_" + id_attr).removeClass( "panel-info" ).addClass( " animateChange" );
                $("#move_" + id_attr).remove();
            }
        })
    });

});