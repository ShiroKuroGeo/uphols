const { createApp } = Vue;

createApp({
    data(){
        return{
            
        }
    },
    methods:{
        recommendation:function(e){
            e.preventDefault();
            var form = e.currentTarget;
            
            const vue = this;
            var data = new FormData(form);
            if(data){
                data.append("Method","recommendation");
                axios.post('Backend/Routes/Members/Admin/recommendation.php',data)
                .then(function(r){
                    if(r.data == 200){
                        toastr.info("Succesfully Send");
                        document.getElementById('reset').reset();
                    }else{
                        alert("Not Send");
                    }
                });
            }else{
                toastr.info("Fill up the fields!");
            }
            
        },
        logout:function(e){
            const vue = this;
            var data = new FormData(form);
            data.append("Method","Logout");
            axios.post('Backend/Routes/Auth/Auth.php',data)
            .then(function(r){
                if(r.data == "logout"){
                    toastr.info("Succesfully Logout");
                    // document.getElementById('reset').reset();
                    window.location.href = "/Uphols/";
                }else{
                    alert("Cannot logout");
                }
            });
            
        }
    }
}).mount('#index-content')