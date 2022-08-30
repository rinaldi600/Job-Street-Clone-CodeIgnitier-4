-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 30 Agu 2022 pada 08.37
-- Versi server: 10.4.19-MariaDB
-- Versi PHP: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `job_portal_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `company`
--

CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `idCompany` varchar(255) NOT NULL,
  `profileCompany` varchar(255) NOT NULL,
  `namaCompany` varchar(255) NOT NULL,
  `emailCompany` varchar(200) NOT NULL,
  `passwordCompany` varchar(255) NOT NULL,
  `handphoneCompany` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `company`
--

INSERT INTO `company` (`id`, `idCompany`, `profileCompany`, `namaCompany`, `emailCompany`, `passwordCompany`, `handphoneCompany`, `alamat`, `created_at`, `updated_at`) VALUES
(5, 'COMPANY - 20220725131006.865722', 'img/company_profile/1658729406_a6e1864ee5b4a270b33f.png', 'PT. Anugrah Jaya Abadi', 'rinaldih84@gmail.com', '$2y$10$riHuOqen9aIlz6TTyJUpZOCdDgviOAdrnloh.N/SGxqmBvqnv9.r.', '081123456789', 'Gg. Suharso No. 221, Bima 77828, Banten', '2022-07-25 06:10:06', '2022-07-25 06:10:06'),
(6, 'COMPANY - 20220829131441.866416', 'img/company_profile/1661753681_8e7423cec8624fd9aca1.png', 'PT. Folio Under Company', 'rinaldihendrawan2@gmail.com', '$2y$10$PS0ePimqvw3K2CbG7/l6.uhQ4pHcTk6sQy1oLQQ3Mh5N25zkYEmgi', '081123456789', 'Gg. Bak Mandi No. 107, Surakarta 80965, DIY', '2022-08-29 06:14:41', '2022-08-29 06:14:41');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cv`
--

CREATE TABLE `cv` (
  `id` int(11) NOT NULL,
  `idCV` varchar(255) NOT NULL,
  `idUser` varchar(255) NOT NULL,
  `idJob` varchar(255) NOT NULL,
  `idResume` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `cv`
--

INSERT INTO `cv` (`id`, `idCV`, `idUser`, `idJob`, `idResume`, `created_at`, `updated_at`) VALUES
(6, 'CV - 630b1469ef8eb', 'USER - 630b141740965', 'JOB - 62e8c528406c5', 'RESUME-630b144b0f125', '2022-08-28 07:08:25', '2022-08-28 07:08:25'),
(7, 'CV - 630b146e19909', 'USER - 630b141740965', 'JOB - 6301de918d333', 'RESUME-630b144b0f125', '2022-08-28 07:08:30', '2022-08-28 07:08:30'),
(8, 'CV - 630c6099d913b', 'USER - 6252f211c78cd', 'JOB - 630c5a00d0c0e', 'RESUME-62b862789f202', '2022-08-29 06:45:45', '2022-08-29 06:45:45'),
(9, 'CV - 630da668d9f74', 'USER - 6252f211c78cd', 'JOB - 62e8c528406c5', 'RESUME-62b862789f202', '2022-08-30 05:55:52', '2022-08-30 05:55:52'),
(10, 'CV - 630da66fe0dc7', 'USER - 6252f211c78cd', 'JOB - 62e8c63f67e6a', 'RESUME-62b862789f202', '2022-08-30 05:55:59', '2022-08-30 05:55:59'),
(11, 'CV - 630da68525d67', 'USER - 6252f211c78cd', 'JOB - 630c5a4d743f6', 'RESUME-62b862789f202', '2022-08-30 05:56:21', '2022-08-30 05:56:21'),
(12, 'CV - 630da7e6472af', 'USER - 6252f211c78cd', 'JOB - 630c5a785a6bb', 'RESUME-62b862789f202', '2022-08-30 06:02:14', '2022-08-30 06:02:14'),
(13, 'CV - 630da83b9c7e8', 'USER - 6252f211c78cd', 'JOB - 630c5a8bb4b9b', 'RESUME-62b862789f202', '2022-08-30 06:03:39', '2022-08-30 06:03:39'),
(14, 'CV - 630da8baf2d1b', 'USER - 630da87bc2144', 'JOB - 62f880c0adc6c', 'RESUME-630da8ac002c7', '2022-08-30 06:05:46', '2022-08-30 06:05:46');

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_desk`
--

CREATE TABLE `job_desk` (
  `id` int(11) NOT NULL,
  `idJob` varchar(255) NOT NULL,
  `idCompany` varchar(255) NOT NULL,
  `namaJob` varchar(255) NOT NULL,
  `deskripsiJob` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `job_desk`
--

INSERT INTO `job_desk` (`id`, `idJob`, `idCompany`, `namaJob`, `deskripsiJob`, `created_at`, `updated_at`, `deleted_at`) VALUES
(5, 'JOB - 62e8c528406c5', 'COMPANY - 20220725131006.865722', 'Front End Developer SAC Indonesia', '<h4>Job Description</h4><p><strong>Job Description:</strong></p><ul><li>Develop User Interface based on design.</li><li>Integrate user-facing elements with server-side APIs.</li><li>Deliver code that is reusable, testable, and efficient.</li></ul><p><strong>Requirements:</strong></p><ul><li>Bachelor degree in Computer Science / Computer Engineering</li><li>Experience 1-3 years in Frontend developer.</li><li>Good understanding of HTML/CSS/Javascript/Typescript.</li><li>Proficient in Javascript and in at least one modern front-end framework such as React.js (preferred), Vue.js, and Svelte</li><li>Good understanding of static site generators (SSG) such as gridsome, Jamstack, Gatsby is highly.</li></ul><p><strong>Specific skills needed:</strong></p><p>HTML, CSS, React, Javascript, Gitlab, GraphQL, Figma</p>', '2022-08-02 06:33:12', '2022-08-02 06:33:12', NULL),
(6, 'JOB - 62e8c63f67e6a', 'COMPANY - 20220725131006.865722', 'Frontend Developer', '<h4>Job Highlights</h4><p>&nbsp;</p><p>Mendapat pengalaman dan wawasan Audit ISO:27001</p><h4>Job Description</h4><p>Tanggung jawab:</p><ul><li>Mendesain dan mengembangkan User Interface aplikasi web dan aplikasi smartphone.</li><li>Membangun aplikasi web perusahaan yang digunakan untuk transaksi, manajemen, reporting, dll.</li><li>Membangun Webview API yang digunakan untuk integrasi dengan mitra lain.</li><li>Mengelola, update dan patching semua aplikasi yang dibuat.</li><li>Melakukan R&amp;D untuk aplikasi baru yang dapat digunakan untuk mengoptimalisasi sistem yang sudah ada.</li></ul><p>Kualifikasi:</p><ul><li>Minimal S1 Teknik Informatika, Sistem Informasi dan sejenisnya</li><li>Mengetahui algoritma dasar pemograman</li><li>Mengetahui konsep SQL dan NoSQL</li><li>Menguasai bahasa pemograman Java /Python&nbsp;</li><li>Mengetahui konsep SDLC</li><li>Mengerti UML Diagram</li><li>Menguasai SQL.</li><li>Mengetahui dasar-dasar linux</li><li>Menguasai basic framework nextjs, flutter.</li></ul>', '2022-08-02 06:37:51', '2022-08-02 06:37:51', NULL),
(7, 'JOB - 62f880c0adc6c', 'COMPANY - 20220725131006.865722', 'Admin Project Internship', '<p><strong>Deskripsi Pekerjaan</strong></p><ul><li>Membantu administrasi penginputan data dan operasional</li></ul><p><strong>Kualifikasi:</strong></p><ul><li>Usia Maksimal 25 Tahun</li><li>Pendidikan minimal D3</li><li>Fasih dalam menggunakan Microsoft Office terutama dalam Excel</li><li>Memiliki kemampuan komunikasi dan interpersonal yang baik</li><li>Lokasi wilayah di Jakarta Barat - Daan Mogot</li></ul>', '2022-08-14 04:57:36', '2022-08-15 05:44:30', NULL),
(8, 'JOB - 62f9dea2446f5', 'COMPANY - 20220725131006.865722', 'Test', '<p>Test</p>', '2022-08-15 05:50:26', '2022-08-15 05:58:02', '2022-08-15 12:58:02'),
(9, 'JOB - 6301de918d333', 'COMPANY - 20220725131006.865722', 'Jr Software Developer', '<p><strong>Job Requirements:</strong></p><ul><li>Minimum Bachelor Degree from Computer Studies</li><li>Have an experience minimal 1 year in related area, fresh graduate are welcome to apply</li><li>Able to operate programming language, Visual Studio 2017/2019 and MS SQL Server</li><li>Know about API (Postman, Swagger), DevOps and Azure</li><li>Open-minded and seeks improvements for current approaches</li><li>Willing to work at Saturday</li><li><strong>Willing to be placed at Jakarta area</strong></li></ul><p><strong>Job Responsibilities:</strong></p><ul><li>Perform application development that match with user\'s requirement and deliver in timely completion</li><li>Provide technical advice in related project to enhance application performance</li><li>Monitor and enhance user\'s satisfaction towards various IS Application Development</li></ul>', '2022-08-21 07:28:17', '2022-08-21 07:28:17', NULL),
(10, 'JOB - 630c5a00d0c0e', 'COMPANY - 20220829131441.866416', 'IT Functional Developer', '<p><strong>Requirements:</strong></p><ul><li>Bachelor degree in Information Technology, Information System &amp; Computer.</li><li>Experience over 1 year of fresh graduate are welcome</li><li>Have experience developing website or app</li><li>Have good knowledge about Database (SQL Server, Oracle, PostgreSQL and Git as Version Control.</li><li>Have good knowledge about programming ( .Net Core, C#, PHP, Javascript,Html &amp; CSS, Bootstrap, Tableau, API )</li><li>Have experienced in making URS and FSD</li><li>Willing to work in Hybrid Working</li></ul>', '2022-08-29 06:17:36', '2022-08-29 06:17:36', NULL),
(11, 'JOB - 630c5a2672da6', 'COMPANY - 20220829131441.866416', 'Software Engineer Fullstack Developer', '<p><strong>Requirements :</strong></p><ul><li>Candidate must possess at least Bachelor\'s Degree in Technical Information / Information System with minimum GPA 3.00 (on a scale of 4.0)</li><li>0-7 years of Software Engineer (Full stack) (Fresh graduate &amp; Senior Position Are available)</li><li>Having a strong analysis, problem solving skills, initiative, team work &amp; Excellent communication skill</li><li>Expertise in PHP Programming Language or at least one programming language for Web Development is must (Full stack)</li><li>This position open for junior and senior level</li></ul><p><strong>Job Description :</strong></p><ul><li>Developing web / mobile application based on business need and requirement</li><li>Testing new software and fixing bugs</li><li>Improving system quality by identifying issues and common patterns, and developing standard operating procedures</li><li>Liaising with colleagues to implement technical designs</li><li>Troubleshooting software issues and debugging a large codebase</li></ul>', '2022-08-29 06:18:14', '2022-08-29 06:18:14', NULL),
(12, 'JOB - 630c5a4d743f6', 'COMPANY - 20220829131441.866416', 'Bootcamp IT Consultant Programmer Fresh Graduate', '<p><strong>Requirements :</strong></p><ul><li>Minimum S1 in Computer Science/Information Technology/ Mathematics/Physics/Telecommunication/Statistic</li><li>Fresh graduates / Entry level applicants are encouraged to apply</li><li>No work experience required</li><li>Minimum 3.00 GPA</li><li>Age maximum 26&nbsp; years old</li><li>Required skill(s): basic programming, algorithm, logic</li><li>Understand relational databases Microsoft SQL Server and its <strong>query language</strong></li><li>Have a high interest in software engineering as Developer</li><li>Fast learner and high logical thinker</li><li>Good communication and eager to learn</li><li><strong>Training will be held at Grogol / Daan Mogot area (West Jakarta)</strong></li><li>30&nbsp;Full-Time position(s) available</li></ul>', '2022-08-29 06:18:53', '2022-08-29 06:18:53', NULL),
(13, 'JOB - 630c5a785a6bb', 'COMPANY - 20220829131441.866416', 'WEB DEVELOPER FRONTEND BACKEND DEVELOPER', '<h4>Keuntungan</h4><ul><li>Comfortable working space and ambiance</li><li>Open to upgrading skill</li><li>Competitive Income and promotion</li></ul><h4>Deskripsi Pekerjaan</h4><ul><li>Build, develop and maintain website&nbsp;</li><li>Identify and fix bugs in our system</li><li>Backend: CRUD (Create, Read, Update, Delete)</li><li>Frontend: Make Responsive Display (Padding, Shadow, Rounded etc.)</li></ul><p>Qualification:</p><ul><li>Bachelor\'s degree, Computer Science/Information Technology (Fresh Graduate are welcome)</li><li>At least 1 year of working experience as Web Developer (Frontend/Backend)</li><li>Deep understanding of HTML, CSS and JavaScript.</li><li>Experience in responsive web designs with CSS framework such as Bootstrap or Tailwind.</li><li>Experience with UI/UX design and Mobile Apps will be an advantage</li><li><strong>Willing to work in Seminyak area (FULL TIME JOB)</strong></li></ul>', '2022-08-29 06:19:36', '2022-08-29 06:19:36', NULL),
(14, 'JOB - 630c5a8bb4b9b', 'COMPANY - 20220829131441.866416', 'Graduate Development Program', '<p><strong>RESPONSIBILITIES:</strong></p><ul><li>Will be train as developer for 3 or 4 months.</li></ul><p><br><strong>REQUIREMENTS:</strong></p><ul><li>Candidate must possess at least Diploma, Bachelor\'s Degree in Computer Science/Information Technology or equivalent.</li><li>Strong knowledge in Java programming language.</li><li>No work experience required.</li><li>Fresh graduate is very welcome.</li><li>Strong conceptual and analytical thinking.</li><li>Eager to learn new skill.</li><li>Have passion in software and application development.</li><li>Must be able to work in a fast paced environment&nbsp;</li></ul>', '2022-08-29 06:19:55', '2022-08-29 06:19:55', NULL),
(15, 'JOB - 630c5aa7bcef9', 'COMPANY - 20220829131441.866416', 'Fullstack Developer', '<p>Hi, talented people! PT. Magna Solusi Indonesia looking for <strong>SOFTWARE DEVELOPER</strong></p><p>Here\'s the <strong>REQUIREMENT</strong></p><ul><li>Minimal Diploma in Computer Science/Information Technology/Engineering/Mathematics/Physics/Science and Technology or equivalent</li><li>Fresh graduate are welcome to apply.</li><li>Proficiency with fundamental front-end languages such as HTML, CSS, and JavaScript.</li><li>Familiarity with JavaScript frameworks such as Angular JS, React, and Amber.</li><li>Proficiency with server-side languages such as Python, Ruby, Java, PHP, and .Net.</li><li>Familiarity with database technology such as MySQL, Oracle, and MongoDB. Informix is a plus</li><li>Like to do coding/programming.</li><li>Highly motivated with spirit to learn new things.</li><li>Good attitude, commitment to work and good team player.</li><li>Good problem solving and analytical skill.</li><li>Ability to work independently or in a group.</li></ul><p>and here\'s your <strong>JOB DESCRIPTION</strong></p><ul><li>Designing and implementing applications based on client needs</li><li>Analyzing user requirements to inform application design</li><li>Defining application objectives and functionality</li><li>Aligning application design with business goals</li><li>Developing and testing software,&nbsp;debugging, and resolving technical problems that arise</li><li>Developing documentation to assist users</li><li>Perform database management (Query, Restore Backup, Tuning, etc.)</li><li>Update progress to Lead and Project Manager.</li></ul>', '2022-08-29 06:20:23', '2022-08-29 06:20:23', NULL),
(16, 'JOB - 630c5abdb3ac7', 'COMPANY - 20220829131441.866416', 'IOS Developer', '<p><strong>Qualification :</strong></p><p>Fresh Graduate Welcome To Apply</p><p>Maximum 5 years experience as IOS Developer</p><p>Knowledge of CI/CD</p><p>Understand Object Oriented Programming</p><p>Familiar with Modular Architecture</p><p>Experienced with Git</p><p>Experienced with Agile/Jira/Confluence</p><p>Familiar with Sonarqube</p><p>Fundamental IOS Development</p><p>Experienced in VIPER Design Pattern and Reactive Programming</p><p>Experienced Develop IOS application with swift, cocoapods, XIB (Interface builder), Moya, RXSwift</p><p>Experienced in Develop Custom View Component</p><p>Familiar with Design Tools (Zeplin/Figma/Origami)</p><p>Contract-based position</p><p><strong>Responsibilities :</strong></p><p>Analyze and give feedback for functional and business requirement</p><p>Produce full code and design, and maintain the code to met with the requirement</p><p>Compile and analyze data, process, and code to fixing defect</p><p>Develop, integrate and maintain software.</p>', '2022-08-29 06:20:45', '2022-08-29 06:20:45', NULL),
(17, 'JOB - 630da950d3d03', 'COMPANY - 20220725131006.865722', 'Junior Programmer Fresh Graduate', '<ul><li>React JS</li><li>Laravel&nbsp;</li><li>CodeIgnitier</li><li>HTML</li><li>CSS</li><li>Javascript</li><li>PHP</li></ul>', '2022-08-30 06:08:16', '2022-08-30 06:08:51', '2022-08-30 13:08:51'),
(18, 'JOB - 630da993cf545', 'COMPANY - 20220725131006.865722', 'Junior Programmer', '<p>React JS Laravel &nbsp;CodeIgnitier HTML CSS Javascript PHP</p>', '2022-08-30 06:09:23', '2022-08-30 06:13:11', '2022-08-30 13:13:11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `resume`
--

CREATE TABLE `resume` (
  `id` int(11) NOT NULL,
  `idResume` varchar(255) NOT NULL,
  `idUser` varchar(255) NOT NULL,
  `addressCVPDF` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `resume`
--

INSERT INTO `resume` (`id`, `idResume`, `idUser`, `addressCVPDF`, `created_at`, `updated_at`) VALUES
(26, 'RESUME-62b862789f202', 'USER - 6252f211c78cd', 'cv/1661839396_664ad4d1adb0382149fd.pdf', '2022-06-26 13:43:20', '2022-08-30 06:03:16'),
(27, 'RESUME-630b144b0f125', 'USER - 630b141740965', 'cv/1661837385_07533f61ae69a66ca065.pdf', '2022-08-28 07:07:55', '2022-08-30 05:29:45'),
(28, 'RESUME-630da8ac002c7', 'USER - 630da87bc2144', 'cv/1661839532_1a7c36b4c5a6a0170490.pdf', '2022-08-30 06:05:32', '2022-08-30 06:05:32');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `idUser` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `handphone` varchar(255) NOT NULL,
  `photo_profile` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `idUser`, `username`, `email`, `password`, `nama`, `handphone`, `photo_profile`, `created_at`, `updated_at`) VALUES
(1, 'USER - 6252f211c78cd', 'Rinaldi007', 'rinaldi84@gmail.com', '$2y$10$wEbQZVhvyCq9QC.ACRPcyu/W5HqDR0nyAH7oAPh6ATIkUwBVSMFR6', 'Rinaldi Hendrawan', '081123456789', 'img/user_profile/10-April-2022 22-04-50.000000/1649603089_66e171a8d89f7e371f65.jpg', '2022-04-10 15:04:50', '2022-04-10 15:04:50'),
(4, 'USER - 630b141740965', 'alan30', 'rinaldih84@gmail.com', '$2y$10$q.pdII4qcoFrGHStsEfvCOQE8T9mvSW7iWjFkDljZ4bxhTvWN5go2', 'Alan Suryajana Setiawan', '081123456789', 'img/user_profile/28-August-2022 14-07-03.000000/1661670423_58e90fe35a98cdfc5a06.jpg', '2022-08-28 07:07:03', '2022-08-28 07:07:03'),
(5, 'USER - 630da87bc2144', 'doni80', 'doni80@gmail.com', '$2y$10$CFOQSakfXwPn0LDlfGmMCewpwY0LG4VN/IVPtBX5TtgkhLJBwUC4q', 'Doni Setiawan', '08970025992', 'img/user_profile/30-August-2022 13-04-43.000000/1661839483_fbe904cdb983a0bded42.jpg', '2022-08-30 06:04:43', '2022-08-30 06:04:43');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_company` (`idCompany`),
  ADD UNIQUE KEY `namaCompany` (`namaCompany`),
  ADD UNIQUE KEY `emailCompany` (`emailCompany`);

--
-- Indeks untuk tabel `cv`
--
ALTER TABLE `cv`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_cv` (`idCV`),
  ADD KEY `fk_id_job` (`idJob`),
  ADD KEY `fk_id_resume` (`idResume`),
  ADD KEY `fk_id_user` (`idUser`);

--
-- Indeks untuk tabel `job_desk`
--
ALTER TABLE `job_desk`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_job` (`idJob`),
  ADD KEY `fk_id_company` (`idCompany`);

--
-- Indeks untuk tabel `resume`
--
ALTER TABLE `resume`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_resume` (`idResume`),
  ADD UNIQUE KEY `idUser` (`idUser`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_user` (`idUser`),
  ADD UNIQUE KEY `username_user` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `cv`
--
ALTER TABLE `cv`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `job_desk`
--
ALTER TABLE `job_desk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `resume`
--
ALTER TABLE `resume`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `cv`
--
ALTER TABLE `cv`
  ADD CONSTRAINT `fk_id_job` FOREIGN KEY (`idJob`) REFERENCES `job_desk` (`idJob`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_id_resume` FOREIGN KEY (`idResume`) REFERENCES `resume` (`idResume`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_id_user` FOREIGN KEY (`idUser`) REFERENCES `user` (`idUser`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `job_desk`
--
ALTER TABLE `job_desk`
  ADD CONSTRAINT `fk_id_company` FOREIGN KEY (`idCompany`) REFERENCES `company` (`idCompany`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `resume`
--
ALTER TABLE `resume`
  ADD CONSTRAINT `fk_id_user_resume` FOREIGN KEY (`idUser`) REFERENCES `user` (`idUser`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
