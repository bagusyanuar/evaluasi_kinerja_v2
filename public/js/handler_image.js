async function handleImageUpload(event)  {
    // console.log(event);
    // const files = event.target.files;
    const files = event[0].files;
    var data = '';
    for (var i = 0; i < files.length; i++) {
        // console.log("FILE ", imageFile)
        const imageFile = files[i];
        console.log('originalFile instanceof Blob', imageFile instanceof Blob); // true
        console.log(`originalFile size ${imageFile.size / 1024 / 1024} MB`);

        const options = {
            maxSizeMB: 0.5,
            maxWidthOrHeight: 1000,
            useWebWorker: true
        };
        try {
            const compressedFile = await imageCompression(imageFile, options);// smaller than maxSizeMB
            data = compressedFile;
            console.log(data)
        } catch (error) {
            console.log(error);
            data = 'error'
        }

    }
    return data;

}
