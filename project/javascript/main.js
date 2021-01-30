
/* GET BUTTONS */
const addPostBtn = document.querySelector("button#send-post-btn");
delPostBtn = document.querySelectorAll(".del-btn");
const acceptProposalEle = document.querySelectorAll(".accept-proposal-btn");


function addEventListeners() {
    if(addPostBtn){
      addPostBtn.addEventListener('click', sendPetPost);
    }
    
    for(let i = 0; i < delPostBtn.length; i++){
      delPostBtn[i].addEventListener('click', deletePost);
    }

    for(let i = 0; i < acceptProposalEle.length; i++){
      acceptProposalEle[i].addEventListener('click', sendAcceptProposal);
    }

}

function encodeForAjax(data) {
    if (data == null) return null;
    return Object.keys(data).map(function(k){
      return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
    }).join('&');
  }

  function sendAjaxRequest(method, url, data, handler) {
    let request = new XMLHttpRequest();
  
    request.open(method, url, true);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    request.addEventListener('load', handler);
    request.send(encodeForAjax(data));
  }

/* SENDERS */

function sendPetPost(event){
 
  event.preventDefault();
  let pet_id = document.getElementById('send-post-btn').getAttribute('data-pet-id');
  let user_id = document.getElementById('send-post-btn').getAttribute('data-user-id');
  let username = document.getElementById('username_session').getAttribute('data-user-id');
  let content = document.getElementById('new-post').value;
  sendAjaxRequest('post', `action-add-post.php`, {pet_id: pet_id, content: content, user_id:user_id, username: username}, addPostHandler);
}

function deletePost(event){
  event.preventDefault();
  let post_id = this.closest('button').getAttribute('data-id');
  sendAjaxRequest('post', 'action-delete-post.php', {post_id: post_id}, delPostHandler);
}

function sendAcceptProposal(event){
  event.preventDefault();
  let proposalID = this.closest('button').getAttribute('data-proposal-id');
  sendAjaxRequest('post', 'action-accept-proposal.php', {proposalID:proposalID}, acceptProposalHandler);
}


/* HANDLERS */

function addPostHandler(){
  let event = JSON.parse(this.responseText);
  console.log(event);
  let date = new Date();
  let year = date.getFullYear();
  let mes = date.getMonth()+1;
  let dia = date.getDate() + 1;
  if(dia < 10){
    dia = '0' + dia;
  }
  date =year+"-"+mes+"-"+dia;

  let post_id = event[0]['post_id'];

  let new_post = document.createElement('div');
  new_post.classList.add('pet-post');
  new_post.setAttribute('id', post_id);
  new_post.innerHTML = `
      <p class="pet-post-poster">
      <span>In` + ` ` + date + `, <b> ` + event[0]['username'] + `: </b></span>
      <span>
        <button class="post-button edit-btn" data-id="` + post_id + `" type="button"><i class="far fa-edit fa-xs edit-post-icon"></i></button>
        <button class="post-button del-btn" data-id="` + post_id + `" type="button"><i class="far fa-trash-alt fa-xs delete-post-icon"></i></button>
      </span>
      </p>
      <p class="pet-post-content">` + event[0]['content'] + `</p>`;
 
  let posts = document.querySelectorAll(".pet-post");
  if(posts.length >= 1){
     let last_post = posts[posts.length - 1];
    last_post.parentNode.insertBefore(new_post, last_post.nextSibling);
  }
  else{
    let posts_column = document.querySelector("#posts-column");
    posts_column.insertBefore(new_post, document.querySelector("#add-new-post"));
  }
 
  delPostBtn = document.querySelectorAll(".del-btn");
  addEventListeners();
}

function delPostHandler(){
  let response = JSON.parse(this.responseText);
  let post_id = response[0]['post_id'];
  let old_post = document.getElementById(post_id);
  old_post.remove();
}

function acceptProposalHandler(){
  let response = JSON.parse(this.responseText);
  let frames = document.querySelectorAll('.frame');
  [].forEach.call(frames, function(del) {
    del.classList.remove("proposal-frame");
  });
  [].forEach.call(frames, function(addclass) {
    addclass.classList.add('frame', 'proposal-frame-inactive');
  });

  let accept_btns = document.querySelectorAll('.accept-container');
  
  let pet_taken = document.createElement('div');
  pet_taken.setAttribute('id', 'taken-' + response[0]['proposal_id']);
  pet_taken.classList.add('accept-container');
  pet_taken.innerHTML = '<span class="unavailable-info">Pet Taken</span>';

  [].forEach.call(accept_btns, function(swap){
  swap.parentNode.appendChild(pet_taken);
   swap.parentNode.removeChild(swap);
  });
}


/* DELETE MESSAGES */

setTimeout(function(){
  let message_to_remove = document.querySelector('.message-frame');
  if(message_to_remove != null){
    message_to_remove.remove();
  }
},6000);

/* VALIDATE INPUTS */

addEventListeners();