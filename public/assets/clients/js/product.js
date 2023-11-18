
//----------slide show------------//

var slide = document.getElementById('img');
var anh = [
    'src/img/product_Sub1.webp',
    'src/img/product_Sub2.webp',
    'src/img/product_Sub3.webp'
];
var len = anh.length;
var index =0;
 function next(){
    if(index ==len -1){
        index=0
        img.src = anh[index]
      
    }else{
        index++;
        img.src = anh[index];
    }
 }
 function pre() {
    if (index == 0) {
        index = len - 1
        img.src = anh[index]
    }
    else {
        index--;
        img.src = anh[index]
    }
}

//--------- validate---------//
var size= document.getElementById('size');
var color = document.getElementById('color');
var flag = true;
function validate(){
    if(size.value=="0" && color.value=="0"){
        alert('Please choose size and color (^.^)');
        document.getElementById('size').style.border="red 1px solid"
        document.getElementById('color').style.border="red 1px solid"
        flag = false;
    }else{
        if(size.value=="0"){
            alert('Please choose size (^.^)');
            document.getElementById('size').style.border="red 1px solid"
            flag=false;
        }else{
            document.getElementById('size').style.border="none";
            flag=true;
        }
        if(color.value=="0"){
            alert('Please choose Color (^.^)')
            flag=false;
        }
        else{
            document.getElementById('color').style.border="none";
            flag= true;
        }     
    }
    if(size.value!="0" && color.value!="0"){
        alert("Added to cart");
        document.getElementById('size').value="0";
        document.getElementById('color').value="0";
        flag= true;
    }

    return flag;
}
