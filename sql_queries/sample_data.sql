-- Insert some users.
INSERT INTO `im_users` (`u_id`, `u_email`, `u_password`, `u_is_admin`, `u_is_active`) VALUES
(1395195137127001, 'vjpaleo@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 0, 1),
(1395201408127001, 'admin@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 1, 1);

-- Insert some image data.
INSERT INTO `im_images` (`i_id`, `i_title`, `i_name`, `i_u_id`, `i_datetime`) VALUES
(3, 'Light House', 'Lighthouse.jpg', 1395195137127001, '2014-03-19 03:49:37'),
(4, 'Its a sunny day!', 'Penguins.jpg', 1395201408127001, '2014-03-19 03:57:22');

