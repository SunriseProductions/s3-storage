<div class="wrap">
    <h2>S3 Storage</h2>
    <form method="POST" action="options.php">
        <?php settings_fields('s3_storage'); ?>
        <table class="form-table">
            <tbody>
                <tr valign="top">
                    <th scope="row">AWS Key</th>
                    <td>
                        <input type="text" id="s3_storage[aws_key]" name="s3_storage[aws_key]" style="width: 300px;" value="<?php echo $options['aws_key']; ?>"/><br/>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">AWS Secret</th>
                    <td>
                        <input type="password" id="s3_storage[aws_secret]" name="s3_storage[aws_secret]" style="width: 300px;" value="<?php if ($options['aws_secret']) { echo 'aws-secret'; } ?>"/><br/>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">S3 Bucket</th>
                    <td>
                        <input type="text" id="s3_storage[s3_bucket]" name="s3_storage[s3_bucket]" style="width: 300px;" value="<?php echo $options['s3_bucket']; ?>"/><br/>
                        <label class="description" for="s3_storage[s3_bucket]">The S3 bucket name, this can include a folder too e.g. my-bucket/uploads.</label>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">CloudFront URL</th>
                    <td>
                        <input type="text" id="s3_storage[cloudfront_url]" name="s3_storage[cloudfront_url]" style="width: 300px;" value="<?php echo $options['cloudfront_url']; ?>"/><br/>
                        <label class="description" for="s3_storage[cloudfront_url]">The CloudFront base URL. If you included a sub-folder above be sure to add that here too.</label>
                    </td>
                </tr>
            </tbody>
        </table>
        <?php submit_button(); ?>
        <input type="hidden" name="s3-storage-submit" value="Y"/>
    </form>
</div>