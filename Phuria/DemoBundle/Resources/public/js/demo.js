var Demo =
{
    baseUrl: null,
    loadProceduresUrl: null,
    loadInitProceduresUrl: null,
    doctorId: null,
    
    select2ManyToMany: function(selector)
    {        
        $(selector).select2({
            placeholder: "Search for a procedure",
            width: "element",
            minimumInputLength: 1,
            multiple: true,
            ajax: 
            {
                url: Demo.loadProceduresUrl,
                dataType: 'json',
                quietMillis: 100,
                data: function (term, page) 
                { // page is the one-based page number tracked by Select2
                    return {
                        query: term, //search term
                    };
                },
                results: function (data, page) 
                {
                    return {results: data};
                }
            },
            initSelection: function(element, callback) 
            {               
                $.ajax({url: Demo.loadInitProceduresUrl + Demo.doctorId, dataType: 'json'})
                .success(function(data){
                    callback(data);
                });
            },
        });
    }, 
    
    prepareClinicsForm: function()
    {
        $('.clinic-box').each(function() {
            Demo.addRemoveButton(this);
        });
        
        Demo.addAddButton();
        $('.remove').click(Demo.removeClinic);
        $('.add').click(Demo.addClinic);
    },
    
    removeClinic: function()
    {
        var clinic = this.parentNode.parentNode.parentNode;
        clinic.parentNode.removeChild(clinic);
    },
    
    addClinic: function()
    {
        var prototype = $('.clinic-form').data('prototype');
        var index = $('.clinic-label').length;
        var node = prototype.replace(/__name__/g, index).replace(/label__/g, '');
        $('.clinic-form').append(node);
        Demo.addRemoveButton($('.clinic-form div:last')[0]);
        $('.remove').click(Demo.removeClinic);
    },
    
    addRemoveButton: function(element)
    {
        var button = document.createElement('div');
        button.innerHTML = '<div class="btn btn-default btn-sm remove">Remove</div>';
        element.appendChild(button);
    },
    
    addAddButton: function()
    {
        var button = document.createElement('div');
        button.innerHTML = '<div class="btn btn-default btn-lg add">Add Clinic</div>';
        $('form div:last').prepend(button);
    }
};

$(document).ready(function(){
    Demo.doctorId = $('#doctorForm_id').val();
    Demo.select2ManyToMany('#doctorForm_procedures');
    Demo.prepareClinicsForm();
});