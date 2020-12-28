<template>
    
    <div class="card-footer text-muted  rounded" style="width: 100%; background-color:white;">
        <div class="d-flex">

                            <input  v-bind:id="comment_textarea" ref="comment_textarea" type="text" name="comment" placeholder="Add a comment..."  style="overflow:auto;resize:none;width:100%; border:none;" @input="checkCommentLength();commentButtonStatus()">
                            
                                <button v-bind:id="commentSendButton" style="background: none;
	                                    color:lightblue;
	                                    border: none;
	                                    padding: 0;
	                                    font: inherit;
	                                    cursor: pointer;
	                                    outline: inherit;"  @click="postComment()" disabled="true">Post</button>
                                        <small v-bind:id="lengthCounter"></small>
                                        </div>
                                          <div v-bind:id="alert_message" class="myalert">
  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
  <strong>Note!</strong> Please type less than 50 letters.
</div>

  </div>
    
</template>

<script>
    export default {
        props: ['postId'],
        methods: {
            postComment() {
                var s;
               s= document.getElementById('comment_textarea'+this.postId).value;
              //  s=this.$refs.comment_textarea.textContent;
                //alert(this.postId);
                if(s.length<=50){
                  axios.post('/p/'+this.postId+'/comment/'+s)
                    .then(response => {
                        if(response.data!='null'){
                        document.getElementById('commentdive'+this.postId).innerHTML='<p style="font-family:verdana"><a href="/profile/'+response.data.id+'" style="text-decoration: none;" class="text-dark"><strong>'+response.data.name+' </strong></a>'+s+'</p>';
                        document.getElementById('comment_textarea'+this.postId).value='';
                        var cCountInc = document.getElementById('commentsCount'+this.postId).innerText;
                        var c =parseInt(cCountInc++);
                        
                        document.getElementById('commentsCount'+this.postId).innerHTML=cCountInc;
                        
                         
            document.getElementById('alert_message'+this.postId).style.display = "none";
            document.getElementById('commentSendButton'+this.postId).disabled = true; 
            document.getElementById('commentSendButton'+this.postId).style.color = "lightblue";
            document.getElementById('lengthCounter'+this.postId).innerHTML ='0/50';
           // document.getElementById( 'ss' ).scrollIntoView();
        
                        }
                    })
                    .catch(errors => {
                        
                    });
                }
                    else console.log('to long comment');
            },

             commentButtonStatus(){
                 console.log("comment_textarea"+this.postId);
        var c;
        if(document.getElementById('comment_textarea'+this.postId).value.match(/^ *$/) !== null)
        {

            document.getElementById('commentSendButton'+this.postId).disabled = true; 
            document.getElementById('commentSendButton'+this.postId).style.color = "lightblue";
        }
        else
        { 
            document.getElementById('commentSendButton'+this.postId).disabled = false; 
            document.getElementById('commentSendButton'+this.postId).style.color = "blue";

        }

        document.getElementById('lengthCounter'+this.postId).innerHTML =document.getElementById('comment_textarea'+this.postId).value.length +'/50'; 
        if(document.getElementById('comment_textarea'+this.postId).value.length>50)
        document.getElementById('lengthCounter'+this.postId).style.color="red";else document.getElementById('lengthCounter'+this.postId).style.color="black";
    },
     checkCommentLength(){
        if(document.getElementById('comment_textarea'+this.postId).value.length>50)
        {
            document.getElementById('alert_message'+this.postId).style.display = "block";
            document.getElementById('commentSendButton'+this.postId).disabled = true; 
            document.getElementById('commentSendButton'+this.postId).style.color = "lightblue";
            document.getElementById('lengthCounter'+this.postId).innerHTML = document.getElementById('comment_textarea'+this.postId).value.length +'/50';


        }
           
         
    }
        },
         computed: {
            comment_textarea() {
                return "comment_textarea"+this.postId;
            },
            commentSendButton(){return "commentSendButton"+this.postId;},
            lengthCounter(){return "lengthCounter"+this.postId;},
            alert_message(){return "alert_message"+this.postId;},

        }
        
    }
</script>