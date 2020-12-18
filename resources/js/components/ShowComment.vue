<template>
    
    <div class=" text-muted  rounded" style="width: 95%; height :3.5rem; background-color:white;">
        <div class="d-flex">

                            <input id="comment_textarea" ref="comment_textarea" type="text" name="comment" placeholder="Add a comment..."  style="overflow:auto;resize:none;width:100%; border:none;" oninput="commentButtonStatus()">
                            
                                <button id="commentSendButton" style="background: none;
	                                    color:lightblue;
	                                    border: none;
	                                    padding: 0;
	                                    font: inherit;
	                                    cursor: pointer;
	                                    outline: inherit;"  @click="postComment" onclick="checkCommentLength()" disabled="true" class="pt-2">Post</button>
                                        <small id="lengthCounter"></small>
                                        </div>
  </div>
    
</template>

<script>
    export default {
        props: ['postId','img'],
        methods: {
            postComment() {
                var s;
               s= document.getElementById('comment_textarea').value;
              //  s=this.$refs.comment_textarea.textContent;
                //alert(this.postId);
                if(s.length<=50){
                  axios.post('/p/'+this.postId+'/comment/'+s)
                    .then(response => {
                        if(response.data!='null'){
                        document.getElementById('commentdive').innerHTML+='<p style="font-family:verdana"><span class="font-weight-bold"><a href="/profile/'+response.data.id+'" class="text-dark" style="text-decoration: none;"><img src="'+this.img+'" class="rounded-circle w-100" style="max-width:1.8rem;"> '+response.data.name+'</a></span> '+s+' &nbsp;• <a class="text-danger" href="/p/'+this.postId+'/delete/'+response.data.commentid+'" onclick="this.style.display='+'none'+';">Delete</a></p>';
                        document.getElementById('comment_textarea').value='';
                        var cCountInc = document.getElementById('commentsCount').innerText;
                        var c =parseInt(cCountInc++);
                        
                        document.getElementById('commentsCount').innerHTML=cCountInc;}
                    })
                    .catch(errors => {
                       
                    });
                }
                    else console.log('to long comment');
            }
        }
        
    }
</script>