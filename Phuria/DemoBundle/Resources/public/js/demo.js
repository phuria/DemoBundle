var Demo =
{
    loadProceduresDataPath: null,
    proceduresData: null,
    
    loadProceduresData: function()
    {
        $.ajax({
            url: this.loadProceduresDataPath,
            dataType: 'json'
        })
        .success(function(data){
            Demo.proceduresData = data;
            Demo.select2ManyToMany('#doctorForm_doctorProceduresValue', Demo.proceduresData);
        });
    },
    
    select2ManyToMany: function(selector, preloadData)
    {
        var onloadValue = $(selector).val().split(',');
        var onloadTags = [];
        
        $.each(onloadValue, function(){
            var id = this;
            $.each(preloadData, function(){
                if(id == this.id)
                {
                    onloadTags.push( { id: this.id, text: this.text });
                }
            });
        });
        
        $(selector).select2({
            width: "element",
            multiple: true,
            query: function (query){
                var data = {results: []};
 
                $.each(preloadData, function(){
                    if(query.term.length == 0 || this.text.toUpperCase().indexOf(query.term.toUpperCase()) >= 0 ){
                        data.results.push({id: this.id, text: this.text });
                    }
                });

                query.callback(data);
            }
        });
        
        $(selector).select2('data', onloadTags);
    }, 
    
    removeUsedAvailableClinics: function()
    {
        var usedClinics = [];
        
        $('#doctorForm_doctorCurrentClinics .clinic-box').each(function() {
            usedClinics.push(this.childNodes[0].value);
        });
        
        $('#doctorForm_doctorAvailableClinics .clinic-box').each(function() {
            var that = this;
            
            $.each(usedClinics, function() {
                if(this == that.childNodes[0].value)
                {
                    that.parentNode.removeChild(that);
                }
            });
        });
    },
    
    prepareClinicsForm: function()
    {
        $('#doctorForm_doctorCurrentClinics .clinic-box').each(function() {
            var id = this.childNodes[0].value;
            var name = this.childNodes[1].value;
            Demo.addClinicButton(this, 'remove', 'Remove', '# ' + id + ' ' + name);
        });
        
        $('#doctorForm_doctorAvailableClinics .clinic-box').each(function() {
            var id = this.childNodes[0].value;
            var name = this.childNodes[1].value;
            Demo.addClinicButton(this, 'add', 'Add', '# ' + id + ' ' + name);
        });
        
        $('.remove').click(Demo.removeClinic);
        $('.add').click(Demo.addClinic);
    },
    
    removeClinic: function()
    {
        var clinic = this.parentNode.parentNode.parentNode;
        var clinicBoxId = this.parentNode.parentNode.id;
        var inputs = $('#' + clinicBoxId + ' input');
        var id = inputs[0].value;
        var name = inputs[1].value;
        var prototype = $('#doctorForm_doctorAvailableClinics').data('prototype');
        Demo.createClinicNode(prototype, '#doctorForm_doctorAvailableClinics', id, name, 'add', 'Add', Demo.addClinic);
        this.parentNode.parentNode.parentNode.parentNode.removeChild(this.parentNode.parentNode.parentNode);
    },
    
    addClinic: function()
    {
        var clinic = this.parentNode.parentNode.parentNode;
        var clinicBoxId = this.parentNode.parentNode.id;
        var inputs = $('#' + clinicBoxId + ' input');
        var id = inputs[0].value;
        var name = inputs[1].value;
        var prototype = $('#doctorForm_doctorCurrentClinics').data('prototype');
        Demo.createClinicNode(prototype, '#doctorForm_doctorCurrentClinics', id, name, 'remove', 'Remove', Demo.removeClinic);
        clinic.parentNode.removeChild(clinic);
    },
    
    createClinicNode: function(prototype, target, id, name, cssClass, buttonValue, onClick)
    {
         var index = parseInt($(target + ' .clinic-label:last').text()) + 1 || 0;
         var node = prototype.replace(/__name__/g, index).replace(/label__/g, '');
         $(target).append(node);
         Demo.addClinicButton($(target + ' .clinic-box:last')[0], cssClass, buttonValue, '# ' + id + ' ' + name);
         $(target + ' .clinic-box:last input:last').val(name);
         $(target + ' .clinic-box:last input:first').val(id);
         $(target + ' .clinic-box:last .' + cssClass).click(onClick);
    },
    
    addClinicButton: function(box, cssClass, buttonValue, labelValue)
    {
        var button = document.createElement('div');
        button.innerHTML = '<div class="btn btn-default btn-sm ' + cssClass + '">' + buttonValue + '</div>'
            + '<p class="button-label">' + labelValue + '</p>';
        box.appendChild(button);
    }
};

$(document).ready(function(){
    Demo.loadProceduresData();
    Demo.prepareClinicsForm();
    Demo.removeUsedAvailableClinics();
});