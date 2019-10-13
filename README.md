# Accessibility

## Overview

The module allows editors to specify [access keys](https://developer.mozilla.org/en-US/docs/Web/HTML/Global_attributes/accesskey) for pages and have them all listed in an access key directory.

## Requirements

 * SilverStripe ^4

## Installation

Install with composer by running:

```sh
composer require silverstripe/accesskeys
```

in the root of your SilverStripe project. Then run a `dev/build`.

## Usage

### Adding Access Keys

In the Settings tab of each page you'll find an Access Key text field. You can enter in any single character in here. This will be available as $AccessKey in the templates. In order for accesskeys to be available, they must be defined as links on all pages. One way to do this is within a hidden div in the footer of your page:

```html
	<div class="hidden accesskeys">
	<% loop AccessKeys %>
		<a href="$Link" accesskey="$AccessKey">$AccessKey = $Title</a>
	<% end_loop %>
	</div>
```

This markup can be found in AccessKey.ss, and can be included in your footer as:

```html
	<% include AccessKeys %>
```

If you do not have styles defined for the hidden class, you should put this in your layout css (or scss) file:

```css
	.hidden{
		display:none;
	}
```

This has already been implemented in the express theme.

### Adding an Access Keys Listing Page

The module adds an Access Keys Listing Page type. Templates for this page can use `$AccessKeys` to list all pages on the site that have an access key set. So for example:

```html
	<% if AccessKeys %>
	<table class="table">
		<thead>
			<tr>
				<th>Key</th>
				<th>Page</th>
			</tr>
		</thead>
		<tbody>
			<% loop AccessKeys %>
				<tr>
					<td>$AccessKey</td>
					<td><a href="$Link">$Title</a></td>
				</tr>
			<% end_loop %>
		</tbody>
	</table>
	<% end_if %>
```

The template for this page type can be found at templates/Silverstripe\AccessKeys\AccessKeysListingPage.ss.
