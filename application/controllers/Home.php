<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Home extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Configuration_model', 'configuration');
		
	}

	public function index()
	{
		$this->load->model('Intro_model', 'intro');
		$this->load->model('Product_model', 'product');
		$this->load->model('Blog_model', 'blog');

		$data['config_web'] = $this->configuration->getConfig();
		$data['title'] = "Beranda";
		$data['mode'] = "index";
		$data['intro'] = $this->intro->getAll() == null ? null : $this->intro->getAll()[0];
		$data['products'] = $this->product->getAll();
		$data['blogs'] = $this->blog->getAll();
		// simplify content only to read
		// get first image src
		foreach ($data['blogs'] as $key => $value) {
			$start_p = strpos($value->content, '<p>');
			$end_p = strpos($value->content, '</p>', $start_p);
			$paragraph = substr($value->content, $start_p, $end_p-$start_p);

			$start_img = strpos($value->content, '<img src="');
			$end_img = strpos($value->content, '">', $start_img);
			$end_img = empty($end_img) ? strpos($value->content, ' xss=', $start_img) : $end_img;
			$src_image = substr($value->content, $start_img+10, $end_img-$start_img-10);

			if (strlen($paragraph) > 147) {
				$value->content = substr($paragraph, 0, 147)."...</p>";
			} else {
				$value->content = $paragraph."...</p>";
			}

			// src image
			$data['blogs'][$key]->src_image = (empty($start_img) || $start_img == null) ? base_url().'assets/img/default_image_blog.jpg' : $src_image;
		}

		$this->load->view('templates/home/header', $data);
		$this->load->view('home/index', $data);
		$this->load->view('templates/home/footer', $data);
	}

	public function blog()
	{
		$this->load->model('Blog_model', 'blog');
		$data['config_web'] = $this->configuration->getConfig();
		$data['title'] = "Blog";
		$data['mode'] = "blog";
		$data['blogs'] = $this->blog->getAll();

		// simplify content only to read
		// get first image src
		foreach ($data['blogs'] as $key => $value) {
			$start_p = strpos($value->content, '<p>');
			$end_p = strpos($value->content, '</p>', $start_p);
			$paragraph = substr($value->content, $start_p, $end_p-$start_p);

			$start_img = strpos($value->content, '<img src="');
			$end_img = strpos($value->content, '">', $start_img);
			$end_img = empty($end_img) ? strpos($value->content, ' xss=', $start_img) : $end_img;
			$src_image = substr($value->content, $start_img+10, $end_img-$start_img-10);

			if (strlen($paragraph) > 147) {
				$value->content = substr($paragraph, 0, 147)."...</p>";
			} else {
				$value->content = $paragraph."...</p>";
			}

			// src image
			$data['blogs'][$key]->src_image = (empty($start_img) || $start_img == null) ? base_url().'assets/img/default_image_blog.jpg' : $src_image;
		}

		$this->load->view('templates/home/header', $data);
		$this->load->view('home/blog', $data);
		$this->load->view('templates/home/footer', $data);
	}

	public function blog_detail($id)
	{
		$this->load->model('Blog_model', 'blog');
		$data['blog'] = $this->blog->get($id);
		$data['config_web'] = $this->configuration->getConfig();
		$data['title'] = $data['blog']->title;
		$data['mode'] = "blog";

		$this->load->view('templates/home/header', $data);
		$this->load->view('home/blog_detail', $data);
		$this->load->view('templates/home/footer', $data);
	}
	public function produk()
	{
		
		$this->load->model('Product_model', 'product');
		$data['config_web'] = $this->configuration->getConfig();
		$data['title'] = "Produk";
		$data['mode'] = "blog";
		$data['produks'] = $this->product->getAll();

		// simplify content only to read
		// get first image src
		foreach ($data['produks'] as $key => $value) {
			$start_p = strpos($value->description , '<p>');
			$end_p = strpos($value->description, '</p>', $start_p);
			$paragraph = substr($value->description, $start_p, $end_p-$start_p);

			$start_img = strpos($value->description, '<img src="');
			$end_img = strpos($value->description, '">', $start_img);
			$end_img = empty($end_img) ? strpos($value->description, ' xss=', $start_img) : $end_img;
			$src_image = substr($value->description, $start_img+10, $end_img-$start_img-10);

			if (strlen($paragraph) > 147) {
				$value->description = substr($paragraph, 0, 147)."...</p>";
			} else {
				$value->description = $paragraph."...</p>";
			}

			// src image
			// $data['produks'][$key]->src_image = (empty($start_img) || $start_img == null) ? base_url().'assets/img/default_image_blog.jpg' : $src_image;
		}

		$this->load->view('templates/home/header', $data);
		$this->load->view('home/umkm', $data);
		$this->load->view('templates/home/footer', $data);
	}

	public function produk_detail($id)
	{
		$this->load->model('Product_model', 'product');
		$data['product'] = $this->product->get($id);
		$data['config_web'] = $this->configuration->getConfig();
		$data['title'] = $data['product']->title;
		$data['mode'] = "blog";

		$this->load->view('templates/home/header', $data);
		$this->load->view('home/produk_detail', $data);
		$this->load->view('templates/home/footer', $data);
	}

	public function gallery()
	{
		$this->load->model('Gallery_model', 'gallery');
		$data['config_web'] = $this->configuration->getConfig();
		$data['title'] = "Galeri";
		$data['mode'] = "gallery";
		$data['galleries'] = $this->gallery->getAll();

		$this->load->view('templates/home/header', $data);
		$this->load->view('home/gallery', $data);
		$this->load->view('templates/home/footer', $data);
	}

	public function tentang()
	{
		$this->load->model('About_model', 'about');
		$this->load->model('Product_model', 'product');
		$this->load->model('Contact_model', 'contact');
		$data['config_web'] = $this->configuration->getConfig();
		$data['title'] = "Tentang Kami";
		$data['mode'] = "about";
		$data['about'] = $this->about->getAll() == null ? null : $this->about->getAll()[0];
		$data['products'] = $this->product->getAll();
		$data['contacts'] = $this->contact->getAll();

		$this->load->view('templates/home/header', $data);
		$this->load->view('home/tentang', $data);
		$this->load->view('templates/home/footer', $data);
	}
}
