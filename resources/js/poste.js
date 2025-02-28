function likePost(postId) {
    fetch(`/post/${postId}/like`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json'
        }
    }).then(response => response.json())
    .then(data => {
        let likeCount = document.getElementById(`like-count-${postId}`);
        let currentCount = parseInt(likeCount.innerText);

        if (data.message === 'Post liké') {
            likeCount.innerText = currentCount + 1;
        } else {
            likeCount.innerText = currentCount - 1;
        }
    });
}



function toggleCommentForm(postId) {
    let commentSection = document.getElementById(`comment-section-${postId}`);
    commentSection.style.display = (commentSection.style.display === "none") ? "block" : "none";
}

function submitComment(postId) {
    let content = document.getElementById(`comment-input-${postId}`).value;

    fetch(`/post/${postId}/comment`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ content: content })
    }).then(response => response.json())
    .then(data => {
        if (data.comment) {
            let commentSection = document.getElementById(`comments-${postId}`);
            let newComment = `<p><strong>${data.comment.user.name}</strong> : ${data.comment.content}</p>`;
            commentSection.innerHTML += newComment;
            document.getElementById(`comment-input-${postId}`).value = "";
        }
    });
}