<script>
    function previewImg() {
        const ava = document.querySelector('#ava')
        const avaLabel = document.querySelector('.costum-file')
        const imgPreview = document.querySelector('.img-preview')

        avaLabel.textContent = ava.files[0].name

        const fileAva = new FileReader()
        fileAva.readAsDataURL(ava.files[0])

        fileAva.onload = function(e) {
            imgPreview.src = e.target.result
        }
    }
</script>