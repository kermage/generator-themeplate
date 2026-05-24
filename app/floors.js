// The oldest versions a fresh Scaffold supports, and the newest WordPress one
// was activated on. Re-check them by hand before each release: WordPress is
// the latest major minus one; PHP and Node.js are the oldest upstream line with
// at least six months of support left, raised to what the Scaffold's
// dependencies need. The generator's own package.json states the same Node.js
// floor, since it installs the Scaffold with the Node.js it runs on.
export default {
	wordpress: '7.0',
	testedUpTo: '7.1',
	php: '8.3',
	node: '22.13.0',
};
