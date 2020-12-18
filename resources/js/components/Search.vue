<template>
    
    <div class="" ><input id="searchInput" type="text" placeholder="search" class=" form-control text-center" @input="search" oninput="searchInput()"/>
                    
                            
                            
                    </div>
    
</template>

<script>
    export default {
        methods: {
            search() {
                document.getElementById('sRes').innerHTML='';
                var s=document.getElementById('searchInput').value;
                document.getElementById('sRes').innerHTML='<a id="noRes" class="dropdown-item font-weight-bold pr-5 rounded" > No resaults</a>';
                    if(s.trim()!=''){
                  axios.post('/search/profile/'+s)
                    .then(response => {
document.getElementById('sRes').innerHTML='<a id="noRes" class="dropdown-item font-weight-bold pr-5 rounded" > No resaults</a>';
                        response.data.forEach(element => {
                            
                            document.getElementById('noRes').style.display="none";
                        document.getElementById('sRes').innerHTML+='<a class="dropdown-item font-weight-bold pr-5 rounded"  href="/profile/'+element.id+'"><img src="/storage/'+element.profile.image+'" class="rounded-circle w-100" style="max-width:1.8rem;"> '+element.name+'</a>';                       
                        });
                            
                        

                            
                   
                    
                    })
                    .catch(errors => {
                        
                    });
                    }
                
            }
        }
        
    }
</script>