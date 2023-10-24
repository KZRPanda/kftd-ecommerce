function hapus_array(data_array,data){
    var temp = []
    var j = 0
    for(var i = 0;i < data_array.length;i++){
        if(data_array[i] == data){
            continue
        }else{
            temp[j] = data_array[i]
            j++
        }
    }
    return temp
}