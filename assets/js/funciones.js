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
            console.log("Success: " + textStatus + ". " + jqXHR + ". " + jsonStr);
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
    CreaTablaAsignaciones();
});

function CreaTablaAsignaciones() {
    var JsonData = { vars: { NomFunction: "CreaTablaAsignaciones", id_sem: $("#CmbCatSemanas").val() } };


    CallBacksAjax("views/soft_resp.php", "POST", JsonData, "html", function(ObjectData) {

        $("#TablaAsignaciones").html(ObjectData);

        $("#TabSemana").DataTable();

    });

}

function EditarRegistroCli(ID) {
    //console.log("Editar Registro:", "Se abre ventana para editar registro: " + ID);
    //Materialize.updateTextFields();
    var JsonData = {
        "vars": { "NomFunction": "GetClienteJson", "id": ID }
    };

    CallBacksAjax("view/AJAX.php", 'POST', JsonData, 'JSON', function(ObjectData) {
        console.log(ObjectData);
        var DatsBD = ObjectData.obj_;
        RecuperaInfoCliente(DatsBD);

        $('#modal1').modal('open');
        Materialize.updateTextFields();
    });
}

function RecuperaInfoCliente(InfoCliente) {
    $('#Id').val(InfoCliente[0]['id']);
    $('#name').val(InfoCliente[0]['name']);
    $('#apaterno').val(InfoCliente[0]['apat']);
    $('#amaterno').val(InfoCliente[0]['amat']);
    $('#callenum').val(InfoCliente[0]['street']);
    $('#direccion').val(InfoCliente[0]['direction']);
    $('#telefono').val(InfoCliente[0]['telephone']);
    $('#sexo').val(InfoCliente[0]['sex']);

    //$('#ta_marca option').removeAttr('selected');
    //$('#ta_marca option[value="' + InfoTabletas[0]['marca'] + '"]').attr('selected', true);
    //$('#ta_marca').val(InfoTabletas[0]['marca']);

}