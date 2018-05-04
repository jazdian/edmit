//setTimeout(function(){ $('#modal1').modal('open'); }, 3000);

function CallBacksAjax(pUrl, pType, pData, pDatatype, MyCallBack) {
    var ObjectData;
    $.ajax({
        url: pUrl,
        type: pType,
        data: { MyJson: pData },
        datatype: pDatatype,
        async: true
    }).done(function(jsonStr, textStatus, jqXHR) {
        if (console && console.log) {
            console.log("Exito: " + textStatus);
        }
        if (pDatatype == 'JSON') {
            ObjectData = JSON.parse(jsonStr);
        } else if (pDatatype == 'html') {
            ObjectData = jsonStr;
        }
        MyCallBack(ObjectData);
        return ObjectData;
    }).fail(function(jqXHR, textStatus, errorThrown) {
        if (console && console.log) {
            console.log("Error: " + textStatus + ". " + errorThrown + ". " + jqXHR);
        }
        ObjectData = "Sorry, Error: " + errorThrown + ". Status: " + textStatus;
        MyCallBack(ObjectData);
        return ObjectData;
    });
}

$(document).ready(function() {
    CreaComboSemanas();
    CreaComboMes();
    OcultarModulos();
    $('#mod1').show(500);
});

function CreaComboSemanas() {

    var JsonData = { "vars": { "NomFunction": "CreaComboSemanas", "id": 1 } };

    CallBacksAjax("views/soft_resp.php", 'POST', JsonData, 'html', function(ObjectDrop) {

        $("#SecDropDownSemanas").html(ObjectDrop);

    });
}

function CreaTablaAsignaciones() {
    var JsonData = { "vars": { "NomFunction": "CreaTablaAsignaciones", "id_sem": $("#CmbCatSemanas").val() } };

    CallBacksAjax("views/soft_resp.php", "POST", JsonData, "html", function(ObjectTable) {

        $("#TablaAsignaciones").html(ObjectTable);
        //console.log(ObjectTable);
        $("#TabSemana").DataTable();

    });
}

function CreaComboMes() {
    var JsonData = { vars: { NomFunction: "CreaComboMes", id: 1 } };

    CallBacksAjax("views/soft_resp.php", "POST", JsonData, "html", function(
        ObjectDrop
    ) {
        $("#SecDropDownMeses").html(ObjectDrop);
        var ObjectDrop2 = ObjectDrop.replace("CmbCatMes", "CmbCatMesGen");
        $("#SecDropDownMesesGen").html(ObjectDrop2);
    });
}

function CreaTablaAsignacionesMes() {

    var JsonData = { "vars": { "NomFunction": "CreaTablaAsignacionesMes", "id_mes": $("#CmbCatMes").val() } };

    CallBacksAjax("views/soft_resp.php", "POST", JsonData, "html", function(ObjectTable) {

        $("#TablaAsignacionesMes").html(ObjectTable);
        //console.log(ObjectTable);
        $("#TabMes").DataTable();
    });
}

//########### ESTA FUNCION GENERA EL REPORTE DE ASJGNACIONES ###############################################################

function GenerarAsignacionesAutomaticas() {

    console.log("Generar Asignaciones Automáticas");
    var JsonData = {
        vars: {
            NomFunction: "GenerarAsignacionesAutomaticas",
            id_mes: $("#CmbCatMesGen").val()
        }
    };

    CallBacksAjax("views/soft_resp.php", "POST", JsonData, "JSON", function(
        ObjectData
    ) {
        console.log(ObjectData);
    });

}



//########### ESTA FUNCION GENERA EL REPORTE DE ASJGNACIONES ###############################################################

//########### ESTA FUNCION GENERA EL PROGRAMA DE ASIGNACIONES ###############################################################

var DatsPub;
var DatsEstud;

$("#SecDropDownMesesGen").change(function() {
    EjecutarCallBackFunciones(LimpiarForm, RecuperarPublicadores, RecuperarEstudios, RecuperarProgramaMes);
});

function EjecutarCallBackFunciones(LimpiarForm, RecuperarPublicadores, RecuperarEstudios, RecuperarProgramaMes) {
    LimpiarForm();
    RecuperarPublicadores();
    RecuperarEstudios();
    RecuperarProgramaMes();
}

function LimpiarForm() {
    $("#ContenedorFormulario").html("");
}

function RecuperarProgramaMes() {
    var JsonData = { vars: { NomFunction: "RecuperarProgramaMes", id_mes: $("#CmbCatMesGen").val() } };

    CallBacksAjax("views/soft_resp.php", "POST", JsonData, "JSON", function(
        ObjectData
    ) {
        //console.log(ObjectData);
        CrearFormularioAsignaciones(ObjectData);
    });
}

function RecuperarPublicadores() {
    var JsonData = { vars: { NomFunction: "RecuperaPublicadores" } };

    CallBacksAjax("views/soft_resp.php", "POST", JsonData, "JSON", function(
        ObjectData
    ) {
        //console.log(ObjectData);
        DatsPub = ObjectData;
    });
}

function RecuperarEstudios() {
    var JsonData = {
        vars: {
            NomFunction: "RecuperaEstudios"
        }
    };

    CallBacksAjax("views/soft_resp.php", "POST", JsonData, "JSON", function(
        ObjectData
    ) {
        //console.log(ObjectData);
        DatsEstud = ObjectData;
    });
}

function CrearFormularioAsignaciones(DatPrograma) {

    CrearFormulario(DatPrograma);

}

function CrearFormulario(DatPrograma) {

    for (var key in DatPrograma) {

        if (DatPrograma.hasOwnProperty(key)) {

            var element = DatPrograma[key];
            var okeys = Object.keys(element);

            CrearDivRow(key);
            CrearDivFormGroup(key, "form-group col-sm-2 col-lg-1", "0");
            if (key === "0") CrearLabel(key, okeys[5], "0");
            CrearInput(element.id_asig, key, okeys[5], "0");

            CrearDivFormGroup(key, "form-group col-sm-10 col-lg-2", "1");
            if (key === "0") CrearLabel(key, okeys[6], "1");
            CrearTextArea(element.asignacion, key, okeys[6], "1");

            CrearDivFormGroup(key, "form-group col-sm-10 col-lg-3", "2");
            if (key === "0") CrearLabel(key, okeys[7], "2");
            CrearTextArea(element.tema, key, okeys[7], "2");

            CrearDivFormGroup(key, "form-group col-sm-10 col-lg-3", "3");
            if (key === "0") CrearLabel(key, "Publicador/Ayudante", "3");
            CrearSelectOption(DatsPub, key, "publicador", "3");
            CrearSelectOption(DatsPub, key, "ayudante", "3");

            CrearDivFormGroup(key, "form-group col-sm-10 col-lg-3", "4");
            if (key === "0") CrearLabel(key, "Estudio", "4");
            CrearSelectOption(DatsEstud, key, "estudio", "4");

        }
    }

}

function CrearDivRow(key, clase) {
    var Div;
    Div = document.createElement("DIV");
    Div.setAttribute("class", "row");
    Div.setAttribute("id", "divrow" + key);
    document.querySelector("#ContenedorFormulario").appendChild(Div);
}

function CrearDivFormGroup(key, clase, uniq) {
    var Div;
    Div = document.createElement("DIV");
    Div.setAttribute("class", clase);
    Div.setAttribute("id", "divcol" + key + uniq);
    document.querySelector("#divrow" + key).appendChild(Div);
}

function CrearLabel(key, okeys, uniq) {
    var Etiqueta;
    Etiqueta = document.createElement("LABEL");
    Etiqueta.setAttribute("for", "input" + key);
    var texto = document.createTextNode(okeys);
    Etiqueta.appendChild(texto);
    document.querySelector("#divcol" + key + uniq).appendChild(Etiqueta);
}

function CrearInput(Id_asig, key, okeys, uniq) {
    var InputId;
    InputId = document.createElement("INPUT");
    InputId.setAttribute("type", "text");
    InputId.setAttribute("value", Id_asig);
    InputId.setAttribute("id", okeys + key);
    InputId.setAttribute("name", okeys + key);
    InputId.setAttribute("disabled", "true");
    InputId.setAttribute("class", "form-control form-control-sm");
    document.querySelector("#divcol" + key + uniq).appendChild(InputId);
}

function CrearTextArea(Id_asig, key, okeys, uniq) {
    var TextArea;
    TextArea = document.createElement("TEXTAREA");
    var txt = document.createTextNode(Id_asig);
    TextArea.appendChild(txt);
    //TextArea.setAttribute("value", Id_asig);
    TextArea.setAttribute("row", "2");
    TextArea.setAttribute("id", okeys + key);
    TextArea.setAttribute("name", okeys + key);
    TextArea.setAttribute("disabled", "true");
    TextArea.setAttribute("class", "form-control form-control-sm");
    document.querySelector("#divcol" + key + uniq).appendChild(TextArea);
}

// Params: Array, Autonum, Nombre o ID, Id Para contenedor DIV
function CrearSelectOption(DatsPub, key, okeys, uniq) {

    var myDiv = document.getElementById("myDiv");

    //Create and append select list
    var selectList = document.createElement("SELECT");
    selectList.id = okeys + key;
    selectList.setAttribute("class", "form-control form-control-sm");

    document.querySelector("#divcol" + key + uniq).appendChild(selectList);

    var option0 = document.createElement("option");
    option0.value = "0";
    option0.text = ".:Seleccione una opción:.";
    selectList.appendChild(option0);

    //Create and append the options
    for (var keyp in DatsPub) {

        if (DatsPub.hasOwnProperty(keyp)) {

            var element = DatsPub[keyp];
            var option = document.createElement("option");
            option.value = element.id;
            option.text = element.text;
            selectList.appendChild(option);
            //console.log("var Element", element);
        }
    }

}

//########### ESTA FUNCION GENERA EL PROGRAMA DE ASIGNACIONES ###############################################################

function MostrarModulo(id_li) {
    OcultarModulos();
    RemoverClassActiv();
    $('#mod' + id_li).show(500);

    if (id_li === 2) {
        CreaTablaAsignaciones();
    } else if (id_li === 3) {
        CreaTablaAsignacionesMes();
    }
    $('#li' + id_li).addClass("active");
}

function OcultarModulos() {

    $('#mod1').hide();
    $('#mod2').hide();
    $('#mod3').hide();
    $('#mod4').hide();
    //$('#mod5').hide();
    //$('#mod6').hide();
    //$('#mod7').hide();
    //$('#mod8').hide();
    //$('#mod9').hide();

}

function RemoverClassActiv() {

    $('#li1').removeClass("active");
    $('#li2').removeClass("active");
    $('#li3').removeClass("active");
    $('#li4').removeClass("active");
    $('#li5').removeClass("active");
    $('#li6').removeClass("active");
    $('#li7').removeClass("active");
    $('#li8').removeClass("active");
    $('#li9').removeClass("active");

}