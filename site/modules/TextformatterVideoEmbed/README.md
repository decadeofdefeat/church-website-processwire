# Video embed for YouTube and Vimeo

ProcessWire Textformatter module that enables translation of YouTube or Vimeo URLs to full embed codes, resulting in a viewable video in textarea fields you apply it to.

## How to install

- Copy the TextformatterVideoEmbed.module file to your /site/modules/ directory (or place it in /site/modules/TextformatterVideoEmbed/). 

- Click *check for new modules* in ProcessWire Admin Modules screen. Click *install* for the module labeled: "Video embed for YouTube/Vimeo".

- Now you will be on the module config screen. Please make note of the config options and set as you see fit.

## How to use

- Edit your *body* field in Setup > Fields (or whatever field(s) you will be placing videos in). On the *details* tab, find the *Text Formatters* field and select "Video embed for YouTube/Vimeo". Save. 

- Edit a page using the field you edited and paste in YouTube and/or Vimeo video URLs each on their own paragraph. 

### Example 

How it might look in your editor (like TinyMCE): 

> Here are two videos about ProcessWire
>
> http://www.youtube.com/watch?v=Wl4XiYadV_k
> 
> http://www.youtube.com/watch?v=XKnG7sikE-U 
> 
> And here is a great video I watched earlier this week:
> 
> http://vimeo.com/18280328

## How it works

This module uses YouTube and Vimeo oEmbed services to generate the embed codes populated in your content. After these services are queried the first time, the embed code is cached so that it doesn't need to be pulled again. 

The advantage of using the oEmbed services is that you get a video formatted at the proper width, height and proportion. You can also set a max width and max height (in the module config) and expect a proportional video. 

## Configuration

You may want to update the max width and max height settings on the module's configuration screen. You should make these consistent with what is supported by your site design. 

If you change these max width / max height settings you may also want to check the box to **clear cache**, so that YouTube/Vimeo oembed services will generate new embed codes for you. 

### Using with Markdown, Textile or other LML

This text formatter is looking for a YouTube or Vimeo video URL surrounded by paragraph tags. As a result, if you are using Markdown or Textile (or something else like it) you want that text formatter to run before this one. 
That ensures that the expected paragraph tags will be present when TextformatterVideoEmbed runs.  You can control the order that text formatters are run in by drag/drop sorting in the field editor.

------
Copyright 2012 by Ryan Cramer

