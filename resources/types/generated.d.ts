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
export type ContactRequestData = {
first_name: string;
last_name: string;
email: string;
phone_number: string;
message: string;
};
export type ImageData = {
full_url: string;
url: string;
position: number;
};
export type PortfolioItemData = {
main_image_full_url: string;
id: number | null;
title_en: string;
title_nl: string;
description_en: string | null;
description_nl: string | null;
main_image_url: string;
website_url: string | null;
position: number;
visible: boolean;
has_case_study: boolean;
case_study_slug: string | null;
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
job_title_en: string;
job_title_nl: string;
text_nl: string;
text_en: string;
image_url: string | null;
image_full_url: string;
position: number;
client_name: string | null;
};
}
declare namespace App.Enums {
export type SettingKey = 'portfolio_items.items_per_page';
}
