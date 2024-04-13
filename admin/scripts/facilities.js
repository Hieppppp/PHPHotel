let facility_s_form = document.getElementById('facility_s_form');
facility_s_form.addEventListener('submit',function(e){
    e.preventDefault();
    add_facility();
});

function add_facility(){
    let data = new FormData();
    data.append('name',facility_s_form.elements['facility_name'].value);
    data.append('icon',facility_s_form.elements['facility_icon'].files[0]);
    data.append('desc',facility_s_form.elements['facility_desc'].value);
    data.append('add_facility','');

    let xhr= new XMLHttpRequest();
    xhr.open("POST","ajax/features_facilities_crud.php",true);
    
    xhr.onload = function(){
        try{
            var myModal = document.getElementById('facility-s');
            var modal = bootstrap.Modal.getInstance(myModal);
            modal.hide();

            if(this.responseText == 'inv_img'){
                alert('error','Chỉ cho phép hình ảnh SVG!');
            }
            else if(this.responseText == 'inv_size'){
                alert('error','Hình ảnh phải nhỏ hơn 1MB!');
            }
            else if(this.responseText == 'upd_failed'){
                alert('error','Tải hình ảnh không thành công. Server Down!');
            }
            else{
                alert('success','Thêm mới thành công');
                facility_s_form.reset();
                get_facilities();
            }
        }
        catch (error){
            alert('error',error.message);
        }  
    }
    xhr.send(data);
}

function get_facilities(){
    let xhr= new XMLHttpRequest();
    xhr.open("POST","ajax/features_facilities_crud.php",true);
    xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
    xhr.onload = function(){
        document.getElementById('facilities-data').innerHTML = this.responseText;
    }
    xhr.send('get_facilities');
}

function rem_facility(val){
    let xhr= new XMLHttpRequest();
    xhr.open("POST","ajax/features_facilities_crud.php",true);
    xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
    xhr.onload = function(){
        try {
            if(this.responseText == 1){
                alert('succsess','Xóa thành công!');
                get_facilities();
            }
            else if(this.responseText == 'room_added'){
                alert('error','Facility is added in room!');
            }
            else{
                alert('error','Server Down!');
            }
        } catch (error) {
            alert('error',error.message);
        }
        
        
    }
    xhr.send('rem_facility='+val);
}

window.onload = function(){
    get_features();
    get_facilities();
}
