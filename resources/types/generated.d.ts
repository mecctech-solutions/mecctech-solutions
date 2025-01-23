declare namespace App.Data {
export type BulletPointData = {
text_en: string;
text_nl: string;
position: number;
};
export type ClientData = {
id: number;
name: string;
website_url: string;
logo_url: string;
logo_full_url: string;
position: number;
};
export type ImageData = {
full_url: string;
url: string;
position: number;
};
export type PortfolioItemData = {
main_image_full_url: string;
title_en: string;
title_nl: string;
description_en: string | null;
description_nl: string | null;
main_image_url: string;
website_url: string;
position: number;
visible: boolean;
bullet_points: Array<App.Data.BulletPointData> | null;
images: Array<App.Data.ImageData> | null;
tags: Array<App.Data.TagData> | null;
};
export type TagData = {
name: string;
visible: boolean;
};
export type TestimonialData = {
id: number;
name: string;
job_title: string | null;
text_nl: string;
text_en: string;
image_url: string | null;
image_full_url: string;
position: number;
};
}
