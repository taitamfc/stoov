jQuery(document).ready(function ($) {
    $("form").validate();
    $("form").submit(function (e) {
        $(".ginput_container").removeClass("erro_box");
        $("form input").each(function (index) {
            $("form input.error").parent().parent().addClass("erro_box");
        });
    });
    $("form .gfield#field_personeel_in_loondienst input[type=radio]").change(
        function (e) {
            e.preventDefault();
            var selected = $(this).val();
            $(" #field_personeel_datum, #field_personeel_tot").slideUp();
            $(" #field_personeel_datum, #field_personeel_tot").prop(
                "disabled",
                true
            );

            if (selected == "1") {
                $(" #field_loonsom, #field_aantal_medewerkers").slideDown();
                $(" #field_loonsom, #field_aantal_medewerkers").prop(
                    "disabled",
                    false
                );
            }
            if (selected == "2") {
                $(" #field_loonsom, #field_aantal_medewerkers").slideDown();
                $(" #field_loonsom, #field_aantal_medewerkers").prop(
                    "disabled",
                    false
                );
                $("#field_personeel_datum, #field_personeel_tot").slideDown();
                $("#field_personeel_datum *, #field_personeel_tot *").prop(
                    "disabled",
                    false
                );
            }
            if (selected == "3") {
                $(
                    "#field_loonsom,#field_aantal_medewerkers ,#field_personeel_datum, #field_personeel_tot"
                ).slideUp();
                $(
                    "#field_loonsom,#field_aantal_medewerkers ,#field_personeel_datum, #field_personeel_tot"
                ).prop("disabled", true);
            }
        }
    );
    $("form .gfield:not(.select_great_more) select").change(function (e) {
        e.preventDefault();
        var data_hide = $(this).attr("name");
        var data_show = $("option:selected", this).attr("data-id");
        if (data_hide) {
            // $(
            //     "select#input_aantal_deelnemers_in_cursus option:first-child"
            // ).prop("selected", true);
            $(".hide." + data_hide).slideUp();
            $(".hide." + data_hide + "  *").prop("disabled", true);
        }
        if (data_show) {
            $(data_show).slideDown();
            data_show = data_show.split(", ");
            $.each(data_show, function (index, value) {
                $(value + " *").prop("disabled", false);
            });
        }
    });
    $("form .gfield.select_great_more select").change(function (e) {
        e.preventDefault();
        var val = $(this).find(":selected").val();
        val = parseInt(val, 10);
        $(".hide.great-more").each(function (i) {
            $great = $(this).attr("data-great-more");
            $great = parseInt($great, 10);
            if ($(this).attr("data-great-more") < val) {
                $(this).slideDown();
                $(this).find("*").prop("disabled", false);
            } else {
                $(this).slideUp();
                $(this).find("*").prop("disabled", true);
            }
        });
    });
    // $("table#employee-table tbody").on("click", "tr", function () {});
    $("#employee-table").on("click", "tbody tr", function (e) {
        e.preventDefault();
        edit = $(this).find("a.edit").attr("href");
        window.location.href = edit;
    });
});
