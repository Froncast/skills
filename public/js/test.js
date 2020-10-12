'use strict';

let search = document.querySelector('input[class="search"]'),
    searchResult = document.querySelector('.search_result'),
    selectItems = document.querySelectorAll('select[name="list_of_skills"]'),
    searchItems = searchResult.querySelectorAll('select[name="list_of_skills"]');

    

let appData = {
    search: function(event){
        let operatorId = event.target.attributes[1].value;
        let skillId = event.target.value;
        // event.path[2].querySelector('.vm_title').style.color = 'red';
        $.ajax({
            type: 'POST',
            url: 'http://'+window.location.hostname+'/skills/ajax',
            data: {
                checkDataSkill: true,
                operatorId: operatorId,
                skillId: skillId,
            },
            success: function(result){
                let json = jQuery.parseJSON(result);
                event.path[2].querySelector('.vm_title').textContent = json.vm_title;
                event.path[2].querySelector('.test_result').textContent = json.testresult;
            }
        });
    },
    search2: function(event){
        console.log(event);
    },
}

search.addEventListener('input', function(event){

    if(search.value.length >= 3){
        $.ajax({
                type: 'POST',
                url: 'http://'+window.location.hostname+'/skills/ajax',
                data: {
                    searchVal: this.value,
                },
                success: function(result){
                    $('.search_result').css('display', 'block');
                    $('.search_result').html(result);
                    searchResult = document.querySelector('.search_result');
                    searchItems = searchResult.querySelectorAll('select[name="list_of_skills"]');
                    searchItems.forEach(function(item){
                        item.addEventListener('change', appData.search);
                    });
                }
            });
    } else{
        searchResult.style.display = 'none';
    }
});

selectItems.forEach(function(item){
    item.addEventListener('change', appData.search);
});

// generate xlsx

// let xlsx = document.querySelector('#getExcel');
// xlsx.addEventListener('click', function(){
//     $.ajax({
//         type: 'POST',
//         url: 'http://'+window.location.hostname+'/skills/ajax',
//         data: {
//             getXlsx: true,
//         },
//         success: function(result){
//             console.log(result);
//         }
//     });
// });