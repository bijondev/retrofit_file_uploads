package com.bkb.retrofituploads;

import com.google.gson.JsonObject;

import okhttp3.MultipartBody;
import okhttp3.RequestBody;
import okhttp3.ResponseBody;
import retrofit2.Call;
import retrofit2.http.Multipart;
import retrofit2.http.POST;
import retrofit2.http.Part;

public interface UploadApis {
    @Multipart
    @POST("upload.php")
    Call<JsonObject> uploadImage(@Part MultipartBody.Part part, @Part("somedata") RequestBody requestBody);
}
