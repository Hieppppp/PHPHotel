let features_s_form = document.getElementById('features_s_form');
features_s_form.addEventListener('submit',function(e){
    e.preventDefault();
    add_features();
});

function add_features(){
    let data = new FormData();
    data.append('name',features_s_form.elements['features_name'].value);
    data.append('add_features','');

    let xhr= new XMLHttpRequest();
    xhr.open("POST","ajax/features_facilities_crud.php",true);
    
    xhr.onload = function(){
        try {
            var myModal = document.getElementById('features-s');
            var modal = bootstrap.Modal.getInstance(myModal);
            modal.hide();

            if(this.responseText == 1){
                alert('success','Thêm mới thành công');
                features_s_form.elements['features_name'].value = '';
                get_features();
            }
            else{
                alert('error','Server Down!');
                
            }
        } catch (error) {
            alert('error',error.message);
            
        } 
    }
    xhr.send(data);
}
function get_features(){
    let xhr= new XMLHttpRequest();
    xhr.open("POST","ajax/features_facilities_crud.php",true);
    xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
    xhr.onload = function(){
        document.getElementById('features-data').innerHTML = this.responseText;
    }
    xhr.send('get_features');
}
function rem_features(val){
    let xhr= new XMLHttpRequest();
    xhr.open("POST","ajax/features_facilities_crud.php",true);
    xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
    xhr.onload = function(){
        if(this.responseText == 1){
            alert('succsess','Xóa thành công!');
            get_features();
        }
        else if(this.responseText == 'room_added'){
            alert('error','Features is added in room!');
        }
        else{
            alert('error','Server Down!');
        }
        
    }
    xhr.send('rem_features='+val);
}

window.onload = function(){
    get_features();
    get_facilities();
}

        
        